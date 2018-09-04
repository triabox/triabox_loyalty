<?php

namespace Amateur\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('isFinish')
            ->add('startTime')
            ->add('startHs')
            ->add('createTime')
            ->add('distance')
            ->add('speed')
            ->add('calories')
            ->add('idMobile')
            ->add('sport', 'entity', array(
            		'label' => 'deporte',
            		'class' => 'ObjectBundle:Sport',
            		'property' => 'name',))
            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amateur\ObjectBundle\Entity\Training'
        ));
    }

    public function getName()
    {
        return 'amateur_objectbundle_trainingtype';
    }
}
