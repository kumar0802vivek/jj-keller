<?php 

/** 
* Generated at: 2016-12-27T13:18:47+01:00
* Inheritance: no
* Variants: no
* Changed by: admin (2)
* IP: 127.0.0.1


Fields Summary: 
- customer_name [input]
- customer_location [input]
- TestimonialDesc [wysiwyg]
- testimonial_category [objects]
*/ 

namespace Pimcore\Model\Object;



/**
* @method static \Pimcore\Model\Object\Testimonial\Listing getByCustomer_name ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Testimonial\Listing getByCustomer_location ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Testimonial\Listing getByTestimonialDesc ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Testimonial\Listing getByTestimonial_category ($value, $limit = 0) 
*/

class Testimonial extends Concrete {

public $o_classId = 3;
public $o_className = "Testimonial";
public $customer_name;
public $customer_location;
public $TestimonialDesc;
public $testimonial_category;


/**
* @param array $values
* @return \Pimcore\Model\Object\Testimonial
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get customer_name - Customer Name
* @return string
*/
public function getCustomer_name () {
	$preValue = $this->preGetValue("customer_name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->customer_name;
	return $data;
}

/**
* Set customer_name - Customer Name
* @param string $customer_name
* @return \Pimcore\Model\Object\Testimonial
*/
public function setCustomer_name ($customer_name) {
	$this->customer_name = $customer_name;
	return $this;
}

/**
* Get customer_location - Location
* @return string
*/
public function getCustomer_location () {
	$preValue = $this->preGetValue("customer_location"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->customer_location;
	return $data;
}

/**
* Set customer_location - Location
* @param string $customer_location
* @return \Pimcore\Model\Object\Testimonial
*/
public function setCustomer_location ($customer_location) {
	$this->customer_location = $customer_location;
	return $this;
}

/**
* Get TestimonialDesc - Description
* @return string
*/
public function getTestimonialDesc () {
	$preValue = $this->preGetValue("TestimonialDesc"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("TestimonialDesc")->preGetData($this);
	return $data;
}

/**
* Set TestimonialDesc - Description
* @param string $TestimonialDesc
* @return \Pimcore\Model\Object\Testimonial
*/
public function setTestimonialDesc ($TestimonialDesc) {
	$this->TestimonialDesc = $TestimonialDesc;
	return $this;
}

/**
* Get testimonial_category - Market
* @return \Pimcore\Model\Object\Market[]
*/
public function getTestimonial_category () {
	$preValue = $this->preGetValue("testimonial_category"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("testimonial_category")->preGetData($this);
	return $data;
}

/**
* Set testimonial_category - Market
* @param \Pimcore\Model\Object\Market[] $testimonial_category
* @return \Pimcore\Model\Object\Testimonial
*/
public function setTestimonial_category ($testimonial_category) {
	$this->testimonial_category = $this->getClass()->getFieldDefinition("testimonial_category")->preSetData($this, $testimonial_category);
	return $this;
}

protected static $_relationFields = array (
  'testimonial_category' => 
  array (
    'type' => 'objects',
  ),
);

public $lazyLoadedFields = NULL;

}

