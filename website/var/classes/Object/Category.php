<?php 

/** 
* Generated at: 2016-12-14T11:14:25+01:00
* Inheritance: no
* Variants: no
* Changed by: admin (2)
* IP: 127.0.0.1


Fields Summary: 
- cat_name [input]
- description [wysiwyg]
- cat_img [image]
*/ 

namespace Pimcore\Model\Object;



/**
* @method static \Pimcore\Model\Object\Category\Listing getByCat_name ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Category\Listing getByDescription ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Category\Listing getByCat_img ($value, $limit = 0) 
*/

class Category extends Concrete {

public $o_classId = 5;
public $o_className = "Category";
public $cat_name;
public $description;
public $cat_img;


/**
* @param array $values
* @return \Pimcore\Model\Object\Category
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get cat_name - Name
* @return string
*/
public function getCat_name () {
	$preValue = $this->preGetValue("cat_name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->cat_name;
	return $data;
}

/**
* Set cat_name - Name
* @param string $cat_name
* @return \Pimcore\Model\Object\Category
*/
public function setCat_name ($cat_name) {
	$this->cat_name = $cat_name;
	return $this;
}

/**
* Get description - Description
* @return string
*/
public function getDescription () {
	$preValue = $this->preGetValue("description"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("description")->preGetData($this);
	return $data;
}

/**
* Set description - Description
* @param string $description
* @return \Pimcore\Model\Object\Category
*/
public function setDescription ($description) {
	$this->description = $description;
	return $this;
}

/**
* Get cat_img - Image
* @return \Pimcore\Model\Asset\Image
*/
public function getCat_img () {
	$preValue = $this->preGetValue("cat_img"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->cat_img;
	return $data;
}

/**
* Set cat_img - Image
* @param \Pimcore\Model\Asset\Image $cat_img
* @return \Pimcore\Model\Object\Category
*/
public function setCat_img ($cat_img) {
	$this->cat_img = $cat_img;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

