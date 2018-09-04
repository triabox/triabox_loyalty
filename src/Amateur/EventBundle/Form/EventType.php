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
            ->add('isActive')
            ->add('isTop')
            ->add('emailContact')
            ->add('startTime')
            ->add('startHs')
            ->add('createTime')
            ->add('photo')
            ->add('photoBackground')
            ->add('linkPage')
            ->add('labelLink')
            ->add('flyerPath')
            ->add('description')
            ->add('distanceTotal')
            ->add('distanceFirstRun')
            ->add('distanceLastRun')
            ->add('distanceSwim')
            ->add('distanceBike')
            ->add('city')
            ->add('province')
            ->add('country')
            ->add('latitude')
            ->add('longitude')
            ->add('categories', 'collection',
            		array('type' => new CategoryType(),
            				'allow_add'    => true,
            				'by_reference' => false,
            				'allow_delete' => true,
            				'prototype' => true))
            
            ->add('entries', 'collection',
            		array('type' => new EntryType(),
            				'allow_add'    => true,
            				'by_reference' => false,
            				'allow_delete' => true,
            				'prototype' => true))
            				->add('classifications', 'collection',
            						array('type' => new ClassificationType(),
            								'allow_add'    => true,
            								'by_reference' => false,
            								'allow_delete' => true,
            								'prototype' => true))
            ->add('sport', 'entity', array(
            		'label' => 'deporte',
            		'class' => 'ObjectBundle:Sport',
            		'property' => 'name',))
            ->add('filePhoto', 'file', array(
            		'label' => 'photo',
            		'required' => false))
            ->add('filePhotoBackground', 'file', array(
            				'label' => 'photoBackground',
            				'required' => false))
            				->add('fileResult', 'file', array(
            						'label' => 'result',
            						'required' => false))
            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amateur\ObjectBundle\Entity\Event'
        ));
    }

    public function getName()
    {
        return 'amateur_objectbundle_eventtype';
    }
}
