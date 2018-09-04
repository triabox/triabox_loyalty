<?php

namespace Amateur\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('createTime')
            ->add('salt')
            ->add('password')
            ->add('isActive')
            ->add('name')
            ->add('lastname')
            ->add('codePassword')
            ->add('photo')
            ->add('tyc')
            ->add('firstTime')
            ->add('language')
            ->add('lastUpdateDate')
            ->add('isOnline')
            ->add('tipeUser')
            ->add('street')
            ->add('number')
            ->add('piso')
            ->add('city')
            ->add('province')
            ->add('country')
            ->add('registrations')
            ->add('birhDate')
            ->add('latitude')
            ->add('longitude')
            ->add('phoneNumber')
            ->add('postalCode')
            ->add('codeState')
            ->add('sport', 'entity', array(
            		'label' => 'deporte',
            		'class' => 'ObjectBundle:Sport',
            		'property' => 'name',))
            ->add('userConfiguration', new UserConfigurationType())
            ->add('file', 'file', array(
            		'label' => 'archivo',
            		'required' => false))
            		
            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amateur\ObjectBundle\Entity\User',
        		'csrf_protection' => false,
        		'csrf_field_name' => '_token',
        		// a unique key to help generate the secret token
        		'intention'       => 'task_item',
        ));
    }

    public function getName()
    {
        return 'amateur_objectbundle_usertype';
    }
}
