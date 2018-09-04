<?php

namespace Amateur\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class PaymentProviderOrganizerType extends AbstractType
{
	
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	

        $builder
            ->add('name')
            ->add('authorizationKey')
            ->add('segurityKey')
            ->add('currencyCode')
            ->add('merchant')
            ->add('isActive');
        
    }

    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amateur\ObjectBundle\Entity\PaymentProviderOrganizer'
        ));
    }

    public function getName()
    {
        return 'amateur_eventbundle_paymentproviderorganizertype';
    }
}
