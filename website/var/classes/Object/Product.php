<?php 

/** 
* Generated at: 2017-01-20T13:24:39+01:00
* Inheritance: no
* Variants: no
* Changed by: admin (2)
* IP: 127.0.0.1


Fields Summary: 
- product_name [input]
- product_code [numeric]
- prod_niche [objects]
- product_category [objects]
- show_subhead [checkbox]
- short_desc [wysiwyg]
- product_desc [wysiwyg]
- product_img [image]
- external_img [externalImage]
- product_type [input]
- brand_name [input]
- sap_desc [wysiwyg]
- sap_meth [wysiwyg]
- subhead [wysiwyg]
- subtype [select]
- show_on_publication [checkbox]
- show_on_full_library [checkbox]
- show_on_market [checkbox]
*/ 

namespace Pimcore\Model\Object;



/**
* @method static \Pimcore\Model\Object\Product\Listing getByProduct_name ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Product\Listing getByProduct_code ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Product\Listing getByProd_niche ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Product\Listing getByProduct_category ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Product\Listing getByShow_subhead ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Product\Listing getByShort_desc ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Product\Listing getByProduct_desc ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Product\Listing getByProduct_img ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Product\Listing getByExternal_img ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Product\Listing getByProduct_type ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Product\Listing getByBrand_name ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Product\Listing getBySap_desc ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Product\Listing getBySap_meth ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Product\Listing getBySubhead ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Product\Listing getBySubtype ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Product\Listing getByShow_on_publication ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Product\Listing getByShow_on_full_library ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Product\Listing getByShow_on_market ($value, $limit = 0) 
*/

class Product extends Concrete {

public $o_classId = 1;
public $o_className = "Product";
public $product_name;
public $product_code;
public $prod_niche;
public $product_category;
public $show_subhead;
public $short_desc;
public $product_desc;
public $product_img;
public $external_img;
public $product_type;
public $brand_name;
public $sap_desc;
public $sap_meth;
public $subhead;
public $subtype;
public $show_on_publication;
public $show_on_full_library;
public $show_on_market;


/**
* @param array $values
* @return \Pimcore\Model\Object\Product
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get product_name - Product Name (Title)
* @return string
*/
public function getProduct_name () {
	$preValue = $this->preGetValue("product_name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->product_name;
	return $data;
}

/**
* Set product_name - Product Name (Title)
* @param string $product_name
* @return \Pimcore\Model\Object\Product
*/
public function setProduct_name ($product_name) {
	$this->product_name = $product_name;
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
* @return \Pimcore\Model\Object\Product
*/
public function setProduct_code ($product_code) {
	$this->product_code = $product_code;
	return $this;
}

/**
* Get prod_niche - Product Niche (Market)
* @return \Pimcore\Model\Object\Market[]
*/
public function getProd_niche () {
	$preValue = $this->preGetValue("prod_niche"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("prod_niche")->preGetData($this);
	return $data;
}

/**
* Set prod_niche - Product Niche (Market)
* @param \Pimcore\Model\Object\Market[] $prod_niche
* @return \Pimcore\Model\Object\Product
*/
public function setProd_niche ($prod_niche) {
	$this->prod_niche = $this->getClass()->getFieldDefinition("prod_niche")->preSetData($this, $prod_niche);
	return $this;
}

/**
* Get product_category - Product Category
* @return \Pimcore\Model\Object\Category[]
*/
public function getProduct_category () {
	$preValue = $this->preGetValue("product_category"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("product_category")->preGetData($this);
	return $data;
}

/**
* Set product_category - Product Category
* @param \Pimcore\Model\Object\Category[] $product_category
* @return \Pimcore\Model\Object\Product
*/
public function setProduct_category ($product_category) {
	$this->product_category = $this->getClass()->getFieldDefinition("product_category")->preSetData($this, $product_category);
	return $this;
}

/**
* Get show_subhead - Show Subhead
* @return boolean
*/
public function getShow_subhead () {
	$preValue = $this->preGetValue("show_subhead"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->show_subhead;
	return $data;
}

/**
* Set show_subhead - Show Subhead
* @param boolean $show_subhead
* @return \Pimcore\Model\Object\Product
*/
public function setShow_subhead ($show_subhead) {
	$this->show_subhead = $show_subhead;
	return $this;
}

/**
* Get short_desc - Short Description
* @return string
*/
public function getShort_desc () {
	$preValue = $this->preGetValue("short_desc"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("short_desc")->preGetData($this);
	return $data;
}

/**
* Set short_desc - Short Description
* @param string $short_desc
* @return \Pimcore\Model\Object\Product
*/
public function setShort_desc ($short_desc) {
	$this->short_desc = $short_desc;
	return $this;
}

/**
* Get product_desc - Product Description
* @return string
*/
public function getProduct_desc () {
	$preValue = $this->preGetValue("product_desc"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("product_desc")->preGetData($this);
	return $data;
}

/**
* Set product_desc - Product Description
* @param string $product_desc
* @return \Pimcore\Model\Object\Product
*/
public function setProduct_desc ($product_desc) {
	$this->product_desc = $product_desc;
	return $this;
}

/**
* Get product_img - Product Image
* @return \Pimcore\Model\Asset\Image
*/
public function getProduct_img () {
	$preValue = $this->preGetValue("product_img"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->product_img;
	return $data;
}

/**
* Set product_img - Product Image
* @param \Pimcore\Model\Asset\Image $product_img
* @return \Pimcore\Model\Object\Product
*/
public function setProduct_img ($product_img) {
	$this->product_img = $product_img;
	return $this;
}

/**
* Get external_img - External Image
* @return \Pimcore\Model\Object\Data\ExternalImage
*/
public function getExternal_img () {
	$preValue = $this->preGetValue("external_img"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->external_img;
	return $data;
}

/**
* Set external_img - External Image
* @param \Pimcore\Model\Object\Data\ExternalImage $external_img
* @return \Pimcore\Model\Object\Product
*/
public function setExternal_img ($external_img) {
	$this->external_img = $external_img;
	return $this;
}

/**
* Get product_type - Prod Hier Level 2
* @return string
*/
public function getProduct_type () {
	$preValue = $this->preGetValue("product_type"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->product_type;
	return $data;
}

/**
* Set product_type - Prod Hier Level 2
* @param string $product_type
* @return \Pimcore\Model\Object\Product
*/
public function setProduct_type ($product_type) {
	$this->product_type = $product_type;
	return $this;
}

/**
* Get brand_name - Prod Hier Level 3
* @return string
*/
public function getBrand_name () {
	$preValue = $this->preGetValue("brand_name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->brand_name;
	return $data;
}

/**
* Set brand_name - Prod Hier Level 3
* @param string $brand_name
* @return \Pimcore\Model\Object\Product
*/
public function setBrand_name ($brand_name) {
	$this->brand_name = $brand_name;
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
	$data = $this->getClass()->getFieldDefinition("sap_desc")->preGetData($this);
	return $data;
}

/**
* Set sap_desc - SAP Description
* @param string $sap_desc
* @return \Pimcore\Model\Object\Product
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
	$data = $this->getClass()->getFieldDefinition("sap_meth")->preGetData($this);
	return $data;
}

/**
* Set sap_meth - Sub Fulfillment Meth
* @param string $sap_meth
* @return \Pimcore\Model\Object\Product
*/
public function setSap_meth ($sap_meth) {
	$this->sap_meth = $sap_meth;
	return $this;
}

/**
* Get subhead - Subhead
* @return string
*/
public function getSubhead () {
	$preValue = $this->preGetValue("subhead"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("subhead")->preGetData($this);
	return $data;
}

/**
* Set subhead - Subhead
* @param string $subhead
* @return \Pimcore\Model\Object\Product
*/
public function setSubhead ($subhead) {
	$this->subhead = $subhead;
	return $this;
}

/**
* Get subtype - subtype
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
* Set subtype - subtype
* @param string $subtype
* @return \Pimcore\Model\Object\Product
*/
public function setSubtype ($subtype) {
	$this->subtype = $subtype;
	return $this;
}

/**
* Get show_on_publication - Show Product on Publication
* @return boolean
*/
public function getShow_on_publication () {
	$preValue = $this->preGetValue("show_on_publication"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->show_on_publication;
	return $data;
}

/**
* Set show_on_publication - Show Product on Publication
* @param boolean $show_on_publication
* @return \Pimcore\Model\Object\Product
*/
public function setShow_on_publication ($show_on_publication) {
	$this->show_on_publication = $show_on_publication;
	return $this;
}

/**
* Get show_on_full_library - Show on Full Library
* @return boolean
*/
public function getShow_on_full_library () {
	$preValue = $this->preGetValue("show_on_full_library"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->show_on_full_library;
	return $data;
}

/**
* Set show_on_full_library - Show on Full Library
* @param boolean $show_on_full_library
* @return \Pimcore\Model\Object\Product
*/
public function setShow_on_full_library ($show_on_full_library) {
	$this->show_on_full_library = $show_on_full_library;
	return $this;
}

/**
* Get show_on_market - Show on Market
* @return boolean
*/
public function getShow_on_market () {
	$preValue = $this->preGetValue("show_on_market"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->show_on_market;
	return $data;
}

/**
* Set show_on_market - Show on Market
* @param boolean $show_on_market
* @return \Pimcore\Model\Object\Product
*/
public function setShow_on_market ($show_on_market) {
	$this->show_on_market = $show_on_market;
	return $this;
}

protected static $_relationFields = array (
  'prod_niche' => 
  array (
    'type' => 'objects',
  ),
  'product_category' => 
  array (
    'type' => 'objects',
  ),
);

public $lazyLoadedFields = array (
  0 => 'product_category',
);

}

