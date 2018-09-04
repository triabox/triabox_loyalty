<?php

namespace Amateur\NewsUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Amateur\ObjectBundle\Entity\Activity;

class NewsUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment')
            ->add('newsPath')
            ->add('createTime')
            ->add('urlImagen')
            ->add('title')
            ->add('description')
            ->add('url')
            ->add('activity', new ActivityType())
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amateur\ObjectBundle\Entity\NewsUser'
        ));
    }

    public function getName()
    {
        return 'amateur_objectbundle_newsusertype';
    }
}
