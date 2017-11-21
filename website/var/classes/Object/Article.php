<?php 

/** 
* Generated at: 2016-12-14T11:11:54+01:00
* Inheritance: no
* Variants: no
* Changed by: admin (2)
* IP: 127.0.0.1


Fields Summary: 
- ArticleName [input]
- publication_name [input]
- editor_name [input]
- ArticleDesc [wysiwyg]
- article_category [objects]
*/ 

namespace Pimcore\Model\Object;



/**
* @method static \Pimcore\Model\Object\Article\Listing getByArticleName ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Article\Listing getByPublication_name ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Article\Listing getByEditor_name ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Article\Listing getByArticleDesc ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Article\Listing getByArticle_category ($value, $limit = 0) 
*/

class Article extends Concrete {

public $o_classId = 2;
public $o_className = "Article";
public $ArticleName;
public $publication_name;
public $editor_name;
public $ArticleDesc;
public $article_category;


/**
* @param array $values
* @return \Pimcore\Model\Object\Article
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get ArticleName - Article Name
* @return string
*/
public function getArticleName () {
	$preValue = $this->preGetValue("ArticleName"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->ArticleName;
	return $data;
}

/**
* Set ArticleName - Article Name
* @param string $ArticleName
* @return \Pimcore\Model\Object\Article
*/
public function setArticleName ($ArticleName) {
	$this->ArticleName = $ArticleName;
	return $this;
}

/**
* Get publication_name - Publication Name
* @return string
*/
public function getPublication_name () {
	$preValue = $this->preGetValue("publication_name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->publication_name;
	return $data;
}

/**
* Set publication_name - Publication Name
* @param string $publication_name
* @return \Pimcore\Model\Object\Article
*/
public function setPublication_name ($publication_name) {
	$this->publication_name = $publication_name;
	return $this;
}

/**
* Get editor_name - Editor Name
* @return string
*/
public function getEditor_name () {
	$preValue = $this->preGetValue("editor_name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->editor_name;
	return $data;
}

/**
* Set editor_name - Editor Name
* @param string $editor_name
* @return \Pimcore\Model\Object\Article
*/
public function setEditor_name ($editor_name) {
	$this->editor_name = $editor_name;
	return $this;
}

/**
* Get ArticleDesc - Description
* @return string
*/
public function getArticleDesc () {
	$preValue = $this->preGetValue("ArticleDesc"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("ArticleDesc")->preGetData($this);
	return $data;
}

/**
* Set ArticleDesc - Description
* @param string $ArticleDesc
* @return \Pimcore\Model\Object\Article
*/
public function setArticleDesc ($ArticleDesc) {
	$this->ArticleDesc = $ArticleDesc;
	return $this;
}

/**
* Get article_category - Market
* @return \Pimcore\Model\Object\Market[]
*/
public function getArticle_category () {
	$preValue = $this->preGetValue("article_category"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("article_category")->preGetData($this);
	return $data;
}

/**
* Set article_category - Market
* @param \Pimcore\Model\Object\Market[] $article_category
* @return \Pimcore\Model\Object\Article
*/
public function setArticle_category ($article_category) {
	$this->article_category = $this->getClass()->getFieldDefinition("article_category")->preSetData($this, $article_category);
	return $this;
}

protected static $_relationFields = array (
  'article_category' => 
  array (
    'type' => 'objects',
  ),
);

public $lazyLoadedFields = NULL;

}

