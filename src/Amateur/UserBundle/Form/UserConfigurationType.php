<?php

namespace Amateur\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('shareWith', 'choice', array(
		    'choices' => array('1' => 'Publico', '2' => 'Amigos'),
		    'preferred_choices' => array('1'),
			))
            ->add('activeFollowMe', 'choice', array(
		    'choices' => array('1' => 'SI', '0' => 'NO'),
		    'preferred_choices' => array('1'),
			));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amateur\ObjectBundle\Entity\UserConfiguration'
        ));
    }

    public function getName()
    {
        return 'amateur_objectbundle_userconfigurationtype';
    }
}
