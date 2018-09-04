<?php

namespace Amateur\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClassificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('categoryName')
            ->add('officialTime')
            ->add('netoTime')
            ->add('extraData')
            ->add('sexo')
            ->add('lastname')
            ->add('overallRank')
            ->add('divRank')
            ->add('bib')
            ->add('swim')
            ->add('bike')
            ->add('runFirst')
            ->add('runLast')
            ->add('secondsNetoTime')
            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amateur\ObjectBundle\Entity\Classification'
        ));
    }

    public function getName()
    {
        return 'amateur_objectbundle_classificationtype';
    }
}
