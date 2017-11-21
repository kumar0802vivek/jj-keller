<?php 

/** 
* Generated at: 2017-01-09T10:31:37+01:00
* Inheritance: no
* Variants: no
* Changed by: admin (2)
* IP: 127.0.0.1


Fields Summary: 
- Name [input]
- company_name [input]
- phone [input]
- email [input]
- comments [wysiwyg]
*/ 

namespace Pimcore\Model\Object;



/**
* @method static \Pimcore\Model\Object\Contactus\Listing getByName ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Contactus\Listing getByCompany_name ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Contactus\Listing getByPhone ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Contactus\Listing getByEmail ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Contactus\Listing getByComments ($value, $limit = 0) 
*/

class Contactus extends Concrete {

public $o_classId = 9;
public $o_className = "Contactus";
public $Name;
public $company_name;
public $phone;
public $email;
public $comments;


/**
* @param array $values
* @return \Pimcore\Model\Object\Contactus
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get Name - Name
* @return string
*/
public function getName () {
	$preValue = $this->preGetValue("Name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Name;
	return $data;
}

/**
* Set Name - Name
* @param string $Name
* @return \Pimcore\Model\Object\Contactus
*/
public function setName ($Name) {
	$this->Name = $Name;
	return $this;
}

/**
* Get company_name - Company Name
* @return string
*/
public function getCompany_name () {
	$preValue = $this->preGetValue("company_name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->company_name;
	return $data;
}

/**
* Set company_name - Company Name
* @param string $company_name
* @return \Pimcore\Model\Object\Contactus
*/
public function setCompany_name ($company_name) {
	$this->company_name = $company_name;
	return $this;
}

/**
* Get phone - Phone
* @return string
*/
public function getPhone () {
	$preValue = $this->preGetValue("phone"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->phone;
	return $data;
}

/**
* Set phone - Phone
* @param string $phone
* @return \Pimcore\Model\Object\Contactus
*/
public function setPhone ($phone) {
	$this->phone = $phone;
	return $this;
}

/**
* Get email - Email
* @return string
*/
public function getEmail () {
	$preValue = $this->preGetValue("email"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->email;
	return $data;
}

/**
* Set email - Email
* @param string $email
* @return \Pimcore\Model\Object\Contactus
*/
public function setEmail ($email) {
	$this->email = $email;
	return $this;
}

/**
* Get comments - Comments
* @return string
*/
public function getComments () {
	$preValue = $this->preGetValue("comments"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("comments")->preGetData($this);
	return $data;
}

/**
* Set comments - Comments
* @param string $comments
* @return \Pimcore\Model\Object\Contactus
*/
public function setComments ($comments) {
	$this->comments = $comments;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

