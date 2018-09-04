<?php
/*
 * Copyright (c) Tyler Sommer
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */
namespace Xtending\SecurityXtendingBundle\Component\Authentication\Handler;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Amateur\ObjectBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;

class OAuthUserProvider implements OAuthAwareUserProviderInterface, UserProviderInterface
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $entityManager;
    /**
     * @var \Orkestra\Bundle\ApplicationBundle\Repository\UserRepository
     */
    protected $repository;
    /**
     * @var \Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface
     */
    protected $encoderFactory;
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager                                      $entityManager
     * @param \Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface $encoderFactory
     */
    public function __construct(EntityManager $entityManager, EncoderFactoryInterface $encoderFactory)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository('ObjectBundle:User');
        $this->encoderFactory = $encoderFactory;
    }
    /**
     * Creates a new user from an OAuth response
     *
     * @todo Should this flush?
     *
     * @param \HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface $response
     *
     * @return \Orkestra\Bundle\ApplicationBundle\Entity\User
     * @throws \RuntimeException
     */
    protected function createUserFromResponse(UserResponseInterface $response)
    {
        if (!$response->getUsername()) {
            // TODO: Enumerate response errors?
            throw new \RuntimeException('Unable to authenticate. An error occurred during OAuth authentication.');
        }
//         $group = $this->entityManager->getRepository('OrkestraApplicationBundle:Group')->findOneBy(array('role' => 'ROLE_USER'));
//         if (!$group) {
//             throw new \RuntimeException('Unable to locate user group with role "ROLE_USER".');
//         }
        $user = new User();
        $userConfiguration = new \Amateur\ObjectBundle\Entity\UserConfiguration();
        $userConfiguration->setShareWith(1);
        $userConfiguration->setActiveFollowMe(1);
        $userConfiguration->setUser($user);
        $user->setUserConfiguration($userConfiguration);
        list ($firstName, $lastName) = explode(' ', $response->getRealName(), 2);
        $user->setUsername($firstName." ".$lastName);
        $user->setName((string) $firstName);
        $user->setLastname($lastName);
//         $user->setGroups($group);
        $user->setCodePassword($response->getUsername());
        $factory = $this->encoderFactory->getEncoder($user);
        $user->setPassword($factory->encodePassword(md5(uniqid(mt_rand(), true)), $user->getSalt()));
        $user->setEmail($response->getEmail());
        $user->setPhoto($response->getProfilePicture());
        $user->setFirstTime(0);
//         $author = new Author();
//         $author->setUser($user);
        $this->entityManager->persist($user);
        $this->entityManager->persist($userConfiguration);
        
        $this->entityManager->flush();
        return $user;
    }
    /**
     * Loads the user by a given UserResponseInterface object.
     *
     * @param UserResponseInterface $response
     *
     * @param \HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface $response
     *
     * @return \Orkestra\Bundle\ApplicationBundle\Entity\User
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        try {
            $user = $this->loadUserByUsername($response->getUsername());
        } catch (UsernameNotFoundException $e) {
            $user = $this->createUserFromResponse($response);
        }
        return $user;
    }
    /**
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return $class === 'Amateur\ObjectBundle\Entity\User';
    }
    /**
     * @param string $username
     *
     * @return \Symfony\Component\Security\Core\User\UserInterface
     * @throws \Symfony\Component\Security\Core\Exception\UsernameNotFoundException
     */
    public function loadUserByUsername($username)
    {
    	
        $user = $this->repository->findOneBy(array('codePassword' => $username));
        if (null === $user) {
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
        }
        return $user;
    }
    /**
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     *
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function refreshUser(UserInterface $user)
    {
        return $this->repository->refreshUser($user);
    }
}