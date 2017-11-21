<?php 

/** 
* Generated at: 2017-01-06T08:08:35+01:00
* Inheritance: no
* Variants: no
* Changed by: admin (2)
* IP: 127.0.0.1


Fields Summary: 
- hier_level2 [input]
- hier_level3 [input]
- product_code [numeric]
- sap_desc [input]
- sap_meth [input]
- prod_niche [input]
- subtype [select]
*/ 

namespace Pimcore\Model\Object;



/**
* @method static \Pimcore\Model\Object\BackendProduct\Listing getByHier_level2 ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\BackendProduct\Listing getByHier_level3 ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\BackendProduct\Listing getByProduct_code ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\BackendProduct\Listing getBySap_desc ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\BackendProduct\Listing getBySap_meth ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\BackendProduct\Listing getByProd_niche ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\BackendProduct\Listing getBySubtype ($value, $limit = 0) 
*/

class BackendProduct extends Concrete {

public $o_classId = 11;
public $o_className = "BackendProduct";
public $hier_level2;
public $hier_level3;
public $product_code;
public $sap_desc;
public $sap_meth;
public $prod_niche;
public $subtype;


/**
* @param array $values
* @return \Pimcore\Model\Object\BackendProduct
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get hier_level2 - Hier Level 2
* @return string
*/
public function getHier_level2 () {
	$preValue = $this->preGetValue("hier_level2"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->hier_level2;
	return $data;
}

/**
* Set hier_level2 - Hier Level 2
* @param string $hier_level2
* @return \Pimcore\Model\Object\BackendProduct
*/
public function setHier_level2 ($hier_level2) {
	$this->hier_level2 = $hier_level2;
	return $this;
}

/**
* Get hier_level3 - Hier Level 3
* @return string
*/
public function getHier_level3 () {
	$preValue = $this->preGetValue("hier_level3"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->hier_level3;
	return $data;
}

/**
* Set hier_level3 - Hier Level 3
* @param string $hier_level3
* @return \Pimcore\Model\Object\BackendProduct
*/
public function setHier_level3 ($hier_level3) {
	$this->hier_level3 = $hier_level3;
	return $this;
}

/**
* Get product_code - Product Code
* @return float
*/
public function getProduct_code () {
	$preValue = $this->preGetValue("product_code"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->product_code;
	return $data;
}

/**
* Set product_code - Product Code
* @param float $product_code
* @return \Pimcore\Model\Object\BackendProduct
*/
public function setProduct_code ($product_code) {
	$this->product_code = $product_code;
	return $this;
}

/**
* Get sap_desc - SAP Description
* @return string
*/
public function getSap_desc () {
	$preValue = $this->preGetValue("sap_desc"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->sap_desc;
	return $data;
}

/**
* Set sap_desc - SAP Description
* @param string $sap_desc
* @return \Pimcore\Model\Object\BackendProduct
*/
public function setSap_desc ($sap_desc) {
	$this->sap_desc = $sap_desc;
	return $this;
}

/**
* Get sap_meth - Sub Fulfillment Meth
* @return string
*/
public function getSap_meth () {
	$preValue = $this->preGetValue("sap_meth"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->sap_meth;
	return $data;
}

/**
* Set sap_meth - Sub Fulfillment Meth
* @param string $sap_meth
* @return \Pimcore\Model\Object\BackendProduct
*/
public function setSap_meth ($sap_meth) {
	$this->sap_meth = $sap_meth;
	return $this;
}

/**
* Get prod_niche - Product Niche
* @return string
*/
public function getProd_niche () {
	$preValue = $this->preGetValue("prod_niche"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->prod_niche;
	return $data;
}

/**
* Set prod_niche - Product Niche
* @param string $prod_niche
* @return \Pimcore\Model\Object\BackendProduct
*/
public function setProd_niche ($prod_niche) {
	$this->prod_niche = $prod_niche;
	return $this;
}

/**
* Get subtype - Sub Type
* @return string
*/
public function getSubtype () {
	$preValue = $this->preGetValue("subtype"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->subtype;
	return $data;
}

/**
* Set subtype - Sub Type
* @param string $subtype
* @return \Pimcore\Model\Object\BackendProduct
*/
public function setSubtype ($subtype) {
	$this->subtype = $subtype;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

