<?php

namespace Netstar\AddressBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Netstar\AddressBookBundle\Entity\Person;
use Netstar\AddressBookBundle\Form\PersonForm;
use Netstar\AddressBookBundle\Task\PersonTask;

class DefaultController extends Controller
{	
	public function listAction(Request $request)
	{
		$persons = $this->getDoctrine()->getEntityManager()->getRepository('NetstarAddressBookBundle:Person')->findAll();
		
		return $this->render('NetstarAddressBookBundle:Default:list.html.twig', array(
			'persons' => $persons,
		));
	}
	
	public function addAction(Request $request)
	{
		$form = $this->createForm(new PersonForm(), new PersonTask());
		
		return $this->render('NetstarAddressBookBundle:Default:person.html.twig', array(
			'form' => $form->createView(),
		));
	}
	
	public function editAction(Request $request)
	{
		$person = $this->getDoctrine()->getEntityManager()->getRepository('NetstarAddressBookBundle:Person')->findOneBy(array('id' => $request->get('id')));
		
		$task = new PersonTask();
		$task->id = $person->getId();
		$task->first_name = $person->getFirstName();
		$task->last_name = $person->getLastName();
		$task->address1 = $person->getAddress1();
		$task->address2 = $person->getAddress2();
		$task->city = $person->getCity();
		$task->zip = $person->getZip();
		$task->phone1 = $person->getPhone1();
		$task->phone2 = $person->getPhone2();
		
		$form = $this->createForm(new PersonForm(), $task);
		
		return $this->render('NetstarAddressBookBundle:Default:person.html.twig', array(
			'form' => $form->createView(),
		));
	}
	
	public function deleteAction(Request $request)
	{
		$person = $this->getDoctrine()->getEntityManager()->getRepository('NetstarAddressBookBundle:Person')->findOneBy(array('id' => $request->get('id')));
		
		$this->getDoctrine()->getEntityManager()->remove($person);
		$this->getDoctrine()->getEntityManager()->flush();
		
		return $this->redirect($this->generateUrl('netstar_address_book_list'));
	}
	
	public function saveAction(Request $request)
	{
		$form = $this->createForm(new PersonForm(), new PersonTask());
		
		if($request->getMethod() == 'POST') {
    		$form->bind($request);
    		
    		if($form->isValid()) {
    			$values = $form->getData();
    			
    			if($values->id) $person = $this->getDoctrine()->getEntityManager()->getRepository('NetstarAddressBookBundle:Person')->findOneBy(array('id' => $values->id));
    			else $person = new Person();
    			
    			$person->setFirstName($values->first_name);
    			$person->setLastName($values->last_name);
    			$person->setAddress1($values->address1);
    			$person->setAddress2($values->address2);
    			$person->setCity($values->city);
    			$person->setZip($values->zip);
    			$person->setPhone1($values->phone1);
    			$person->setPhone2($values->phone2);
    			
    			$this->getDoctrine()->getEntityManager()->persist($person);
    			
    			$this->getDoctrine()->getEntityManager()->flush();
			}
		}
		
		return $this->redirect($this->generateUrl('netstar_address_book_list'));
	}
	
	
	
	
}
