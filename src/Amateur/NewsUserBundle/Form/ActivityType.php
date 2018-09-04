<?php

namespace Amateur\NewsUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment')
            ->add('distance')
            ->add('time')
            ->add('sport', 'entity', array(
            		'label' => 'deporte',
            		'class' => 'ObjectBundle:Sport',
            		'property' => 'name',))
            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amateur\ObjectBundle\Entity\Activity'
        ));
    }

    public function getName()
    {
        return 'amateur_objectbundle_newsusertype';
    }
}
