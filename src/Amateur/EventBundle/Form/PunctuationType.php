<?php

namespace Amateur\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PunctuationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('location')
            ->add('circuit')	
            ->add('organization')
            ->add('nutrition')
            ->add('punctuality')
            ->add('assistance')
            ->add('kit')
            ->add('mostPositive')
            ->add('mostNegative')
            ->add('comment')            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amateur\ObjectBundle\Entity\Punctuation'
        ));
    }

    public function getName()
    {
        return 'amateur_objectbundle_punctuationType';
    }
}
