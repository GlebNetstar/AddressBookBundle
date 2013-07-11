<?php 

namespace Netstar\AddressBookBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;


class PersonForm extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('id', 'hidden');
		$builder->add('first_name', 'text');
		$builder->add('last_name', 'text');
		$builder->add('address1', 'text');
		$builder->add('address2', 'text');
		$builder->add('city', 'text');
		$builder->add('zip', 'text');
		$builder->add('phone1', 'text');
		$builder->add('phone2', 'text');
		
	}
	
	public function getName()
	{
		return 'person_form';
	}
}


?>
