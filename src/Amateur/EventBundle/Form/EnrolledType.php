<?php

namespace Amateur\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Amateur\ObjectBundle\Entity\Entry;
use Amateur\EventBundle\Services\EventServices;

class EnrolledType extends AbstractType
{
	
	
        protected $categories;
        protected $entries;
		protected $available;
		protected $eventServices;
		
	public function __construct($event,$controller)
	{
		
                $this->categories = $event->getCategories();
//                 $this->entries = $this->filterEntryWithOutPlace($event->getEntries());
                $this->eventServices  = new EventServices($controller);
                $this->entries = $this->eventServices->getEntryValidByEvent($event->getId());
		
	}
	
	
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number')
            ->add('code')	
            ->add('time') 
            ->add('objetive')
            ->add('seconds')
            ->add('available', null, array(
   				 'data' => $this->available,
				))
            ->add('category', 'entity', array(
            				'label' => 'category',
            				'class' => 'ObjectBundle:Category',
            				'choices' => $this->categories,
		            		'attr' => array(
		            				'style'=>"width:500px"
		            		),
            				))
            ->add('entry', 'entity', array(
            						'label' => 'entradas',
            						'class' => 'ObjectBundle:Entry',
            						'choices' => $this->entries,
            						'attr' => array(
            								'style'=>"width:500px"
            						),
            				))
            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amateur\ObjectBundle\Entity\Enrolled'
        ));
    }
    
    public function filterEntryWithOutPlace($entries){
    	$entriesReturn = new ArrayCollection();
    	
    	foreach($entries as $entrie) {
    		
    		if($entrie->getCant() > 0){
    			$entriesReturn->add($entrie);
    		}
    		
    	}
    	
    	$this->available = $entriesReturn->count();
    	return $entriesReturn;
    }

    public function getName()
    {
        return 'amateur_objectbundle_enrolledType';
    }
}
