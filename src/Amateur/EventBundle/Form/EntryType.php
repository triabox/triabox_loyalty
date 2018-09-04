<?php

namespace Amateur\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

class EntryType extends AbstractType
{
	
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	

        $builder
            ->add('name')
            ->add('cant')
            ->add('amount')
            ->add('description')
            ->add('start')
            ->add('end')
            ->add('isActive');
        
    }

    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amateur\ObjectBundle\Entity\Entry'
        ));
    }

    public function getName()
    {
        return 'amateur_eventbundle_entrytype';
    }
}
