<?php 

/** 
* Generated at: 2017-01-10T09:15:56+01:00
* Inheritance: no
* Variants: no
* Changed by: admin (2)
* IP: 127.0.0.1


Fields Summary: 
- Htmlblock [wysiwyg]
- zone [input]
- priority [numeric]
- use_case [textarea]
- product_codes [textarea]
*/ 

namespace Pimcore\Model\Object;



/**
* @method static \Pimcore\Model\Object\HtmlBlock\Listing getByHtmlblock ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\HtmlBlock\Listing getByZone ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\HtmlBlock\Listing getByPriority ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\HtmlBlock\Listing getByUse_case ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\HtmlBlock\Listing getByProduct_codes ($value, $limit = 0) 
*/

class HtmlBlock extends Concrete {

public $o_classId = 10;
public $o_className = "HtmlBlock";
public $Htmlblock;
public $zone;
public $priority;
public $use_case;
public $product_codes;


/**
* @param array $values
* @return \Pimcore\Model\Object\HtmlBlock
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get Htmlblock - Htmlblock
* @return string
*/
public function getHtmlblock () {
	$preValue = $this->preGetValue("Htmlblock"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("Htmlblock")->preGetData($this);
	return $data;
}

/**
* Set Htmlblock - Htmlblock
* @param string $Htmlblock
* @return \Pimcore\Model\Object\HtmlBlock
*/
public function setHtmlblock ($Htmlblock) {
	$this->Htmlblock = $Htmlblock;
	return $this;
}

/**
* Get zone - zone
* @return string
*/
public function getZone () {
	$preValue = $this->preGetValue("zone"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->zone;
	return $data;
}

/**
* Set zone - zone
* @param string $zone
* @return \Pimcore\Model\Object\HtmlBlock
*/
public function setZone ($zone) {
	$this->zone = $zone;
	return $this;
}

/**
* Get priority - Priority
* @return float
*/
public function getPriority () {
	$preValue = $this->preGetValue("priority"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->priority;
	return $data;
}

/**
* Set priority - Priority
* @param float $priority
* @return \Pimcore\Model\Object\HtmlBlock
*/
public function setPriority ($priority) {
	$this->priority = $priority;
	return $this;
}

/**
* Get use_case - Use Case
* @return string
*/
public function getUse_case () {
	$preValue = $this->preGetValue("use_case"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->use_case;
	return $data;
}

/**
* Set use_case - Use Case
* @param string $use_case
* @return \Pimcore\Model\Object\HtmlBlock
*/
public function setUse_case ($use_case) {
	$this->use_case = $use_case;
	return $this;
}

/**
* Get product_codes - Product Codes
* @return string
*/
public function getProduct_codes () {
	$preValue = $this->preGetValue("product_codes"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->product_codes;
	return $data;
}

/**
* Set product_codes - Product Codes
* @param string $product_codes
* @return \Pimcore\Model\Object\HtmlBlock
*/
public function setProduct_codes ($product_codes) {
	$this->product_codes = $product_codes;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

