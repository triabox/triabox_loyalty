<?php
/*
 * Copyright (c) Tyler Sommer
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */
namespace Xtending\SecurityXtendingBundle\Component\Authentication\Handler;
use HWI\Bundle\OAuthBundle\Security\Core\Authentication\Token\OAuthToken;
use HWI\Bundle\OAuthBundle\Security\Core\Exception\OAuthAwareExceptionInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use HWI\Bundle\OAuthBundle\Security\Http\ResourceOwnerMap;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
/**
 * Custom OAuthProvider which is not so eager to hit up the remote webserver
 */
class OAuthProvider implements AuthenticationProviderInterface
{
    /**
     * @var ResourceOwnerMap
     */
    protected  $resourceOwnerMap;
    /**
     * @var OAuthAwareUserProviderInterface
     */
    protected $userProvider;
    /**
     * @var UserCheckerInterface
     */
    protected $userChecker;
    /**
     * @param OAuthAwareUserProviderInterface $userProvider     User provider
     * @param ResourceOwnerMap                $resourceOwnerMap Resource owner map
     * @param UserCheckerInterface            $userChecker      User checker
     */
    public function __construct(OAuthAwareUserProviderInterface $userProvider, ResourceOwnerMap $resourceOwnerMap, UserCheckerInterface $userChecker)
    {
        $this->userProvider     = $userProvider;
        $this->resourceOwnerMap = $resourceOwnerMap;
        $this->userChecker      = $userChecker;
    }
    /**
     * {@inheritDoc}
     */
    public function supports(TokenInterface $token)
    {
        return $token instanceof OAuthToken;
    }
    /**
     * {@inheritDoc}
     */
    public function authenticate(TokenInterface $token)
    {
        /* @var OAuthToken $token */
        $resourceOwner = $this->resourceOwnerMap->getResourceOwnerByName($token->getResourceOwnerName());
        $user = null;
        if (!$token->isExpired()) {
            try {
                $user = $this->userProvider->loadUserByUsername($token->getUsername());
            } catch (\Exception $e) {
                // no op
            }
        }
        if (!$user) {
            $userResponse = $resourceOwner->getUserInformation($token->getRawToken());
            try {
                $user = $this->userProvider->loadUserByOAuthUserResponse($userResponse);
            } catch (OAuthAwareExceptionInterface $e) {
                $e->setToken($token);
                $e->setResourceOwnerName($token->getResourceOwnerName());
                throw $e;
            }
        }

        $token = new OAuthToken($token->getRawToken(), array ('ROLE_USER'));
        $token->setResourceOwnerName($resourceOwner->getName());
        $token->setUser($user);
        $token->setAuthenticated(true);
        $this->userChecker->checkPostAuth($user);
        return $token;
    }
    }