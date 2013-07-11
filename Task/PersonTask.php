<?php 

namespace Netstar\AddressBookBundle\Task;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraints as Assert;


class PersonTask
{
	public $id;
	public $first_name;
	public $last_name;
	public $address1;
	public $address2;
	public $city;
	public $zip;
	public $phone1;
	public $phone2;
}

?>
