<?php

namespace Amateur\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

class ReportsSportType extends AbstractType
{
	protected $enrolled;
	
	public function __construct($enrolled)
	{
		$this->enrolled = $enrolled;
	
	}
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	
        $builder
            ->add('sport')
            ->add('distance')
            ->add('enrolleds');
        ;
    }

    private function getArrayToSelect(array $value,array $key){
    	
    	$array = array();
    	$cant = 0;
    	foreach ($value as $v){
    		$array[$key[$cant]] = $v;
    		$cant = $cant + 1;
    	}
    	
    	return $array;
    	
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amateur\ObjectBundle\Entity\Category'
        ));
    }

    public function getName()
    {
        return 'amateur_eventbundle_categorytype';
    }
}
