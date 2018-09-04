<?php

namespace Xtending\RoleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name' ,'text',array('label' => 'nombre',))
            ->add('role' ,'text' ,array('label' => 'rol ',))

            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Xtending\EntityBundle\Entity\Role'
        ));
    }

    public function getName()
    {
        return 'xtending_entidadesbundle_roletype';
    }
}
