<?php 

/** 
* Generated at: 2016-12-14T11:15:36+01:00
* Inheritance: no
* Variants: no
* Changed by: admin (2)
* IP: 127.0.0.1


Fields Summary: 
- market_name [input]
- niche_code [multiselect]
- priority [select]
*/ 

namespace Pimcore\Model\Object;



/**
* @method static \Pimcore\Model\Object\Market\Listing getByMarket_name ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Market\Listing getByNiche_code ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Market\Listing getByPriority ($value, $limit = 0) 
*/

class Market extends Concrete {

public $o_classId = 4;
public $o_className = "Market";
public $market_name;
public $niche_code;
public $priority;


/**
* @param array $values
* @return \Pimcore\Model\Object\Market
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get market_name - Market Name
* @return string
*/
public function getMarket_name () {
	$preValue = $this->preGetValue("market_name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->market_name;
	return $data;
}

/**
* Set market_name - Market Name
* @param string $market_name
* @return \Pimcore\Model\Object\Market
*/
public function setMarket_name ($market_name) {
	$this->market_name = $market_name;
	return $this;
}

/**
* Get niche_code - Niche Code
* @return array
*/
public function getNiche_code () {
	$preValue = $this->preGetValue("niche_code"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->niche_code;
	return $data;
}

/**
* Set niche_code - Niche Code
* @param array $niche_code
* @return \Pimcore\Model\Object\Market
*/
public function setNiche_code ($niche_code) {
	$this->niche_code = $niche_code;
	return $this;
}

/**
* Get priority - Priority
* @return string
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
* @param string $priority
* @return \Pimcore\Model\Object\Market
*/
public function setPriority ($priority) {
	$this->priority = $priority;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

