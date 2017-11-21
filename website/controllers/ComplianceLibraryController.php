<?php

use Website\Controller\Action;

class ComplianceLibraryController extends Action {

    public $pagesize = 2;

    public function init() {
        parent::init();
    }

    public function defaultAction() {
        //$this->enableLayout();
    }

    public function newLayoutAction() {
        $this->enableLayout();
    }

    public function aboutLibraryAction() {
        $this->enableLayout();
    }

    public function aboutJJKellerAction() {
        $this->enableLayout();
    }

    /**
     * Method to list all testimonials respective to Markets
     */
    public function testimonialAction() {
        $this->enableLayout();
        $perpagerow = $this->config->pagerow;
        $offset = 0;

        $markets = $this->getAllMarketsAction();
        if (null !== $this->getParam('marketName')) {
            $marketName = preg_replace("/[^a-zA-Z0-9]/", "", str_replace(" ", "", $this->_getParam('marketName')));
            $marketId = Website_Library::getMarketByKey($marketName);
        } else {
            //$marketName = $markets[0]['key'];
            $marketId = $markets[0]['id'];
        }
        $testmonialPaginator = array();
        $arrTestimonials = array();
        if (count($markets) > 0 && $marketId !== null) {
            $testimonialListings = new Object\Testimonial\Listing();
            $testimonialListings->setCondition("testimonial_category LIKE ?", ["%," . $marketId . ",%"]);
            $testimonialListings->setOrderKey("o_modificationDate");
            $testimonialListings->setOrder("DESC");
            $testimonialListings->setOffset($offset);
            $testimonialListings->setLimit($perpagerow);
            if (count($testimonialListings) > 0) {
                foreach ($testimonialListings as $testimonialListingskey => $testimonial) {
                    if (count($testimonial->getTestimonial_category()) > 0) {
                        //if ($marketName == $testimonial->getTestimonial_category()[0]->getKey()) {
                        $arrTestimonials[$testimonialListingskey]['testimonial_id'] = $testimonial->getId();
                        $arrTestimonials[$testimonialListingskey]['customerName'] = $testimonial->getCustomer_name();
                        $arrTestimonials[$testimonialListingskey]['customerLocation'] = $testimonial->getCustomer_location();
                        $arrTestimonials[$testimonialListingskey]['testimonialDesc'] = $testimonial->getTestimonialDesc();
                        //}
                    }
                }
            }
        }
        
        if(count($arrTestimonials) == 0 ) {
            $markets = array();
        }

        $this->view->testimonials = $arrTestimonials;
        $this->view->markets = $markets;
    }

    /**
     * Method to list all testimonials respective to Markets
     */
    public function testimonialAjaxloadAction() {
        $perpagerow = $this->config->pagerow;
        if (null !== $this->getParam('scrollcount')) {
	    $scrollcount = preg_replace("/[^0-9]/", "", str_replace(" ", "", $this->_getParam('scrollcount')));
            $offset = $perpagerow * $scrollcount;
        } else {
            $offset = 0;
        }

        $markets = $this->getAllMarketsAction();
        if (null !== $this->getParam('currentMarket')) {
            $marketName = preg_replace("/[^a-zA-Z0-9]/", "", str_replace(" ", "", $this->_getParam('currentMarket')));
            $marketId = Website_Library::getMarketByKey($marketName);
        } else {
            //$marketName = $markets[0]['key'];
            $marketId = $markets[0]['id'];
        }

        $testimonialListings = new Object\Testimonial\Listing();
        $testimonialListings->setCondition("testimonial_category LIKE ?", ["%," . $marketId . ",%"]);
        $testimonialListings->setOrderKey("o_modificationDate");
        $testimonialListings->setOrder("DESC");
        $testimonialListings->setOffset($offset);
        $testimonialListings->setLimit($perpagerow);
        if (count($testimonialListings) > 0) {
            foreach ($testimonialListings as $testimonialListingskey => $testimonial) {
                if (count($testimonial->getTestimonial_category()) > 0) {
                    $arrTestimonials[$testimonialListingskey]['testimonial_id'] = $testimonial->getId();
                    $arrTestimonials[$testimonialListingskey]['customerName'] = $testimonial->getCustomer_name();
                    $arrTestimonials[$testimonialListingskey]['customerLocation'] = $testimonial->getCustomer_location();
                    $arrTestimonials[$testimonialListingskey]['testimonialDesc'] = $testimonial->getTestimonialDesc();
                }
            }
        }
        echo json_encode(array('status' => 'ok', 'ajaxData' => $arrTestimonials), JSON_FORCE_OBJECT);
        exit;
    }

    /**
     * Method to list all article respective to Markets
     */
    public function articleAction() {
        $this->enableLayout();
        $perpagerow = $this->config->pagerow;
        $offset = 0;
        //$acticleId = preg_replace("/[^a-zA-Z0-9]/", "", $this->_getParam('acticleId'));
        $acticleId = preg_replace("/[^0-9]/", "", str_replace(" ", "", $this->_getParam('acticleId')));
        if ($acticleId) {
            $articleDetailsArr = array();
            $articleDetails = \Pimcore\Model\Object\Article::getById($acticleId, true);
            if ($articleDetails) {
                $articleDetailsArr['article_id'] = $acticleId;
                $articleDetailsArr['article_name'] = $articleDetails->getArticleName();
                $articleDetailsArr['editor_name'] = $articleDetails->getEditor_name();
                $articleDetailsArr['publication_name'] = $articleDetails->getPublication_name();
                $articleDetailsArr['posted_date'] = date("m/d/Y", $articleDetails->getcreationDate());
                $articleDetailsArr['article_desc'] = $articleDetails->getArticleDesc();
                $marketName = '';
                if ($articleDetails->getArticle_category()) {
                    $marketName = $articleDetails->getArticle_category()[0]->getKey();
                }
                $articleArr['market'] = $marketName;
            }
            $this->view->articleDetails = $articleDetailsArr;
        } else {
            //getting all markets 
            $markets = $this->getAllMarketsAction();
            $articleObj = new \Pimcore\Model\Object\Article\Listing();

            if (null !== $this->getParam('marketName')) {
                $marketName = $this->getParam('marketName');
                $marketName = preg_replace("/[^a-zA-Z0-9]/", "", str_replace(" ", "", $marketName));
            } else {
                $marketName = $markets[0]['key'];
            }
            $articleCategory = Website_Library::getMarketByKey($marketName);
            $articleObj->setCondition("article_category LIKE '%," . $articleCategory . ",%'");
            $articleObj->setOrderKey("o_modificationDate");
            $articleObj->setOrder("DESC");
            $articleObj->setOffset($offset);
            $articleObj->setLimit($perpagerow);

            $articlePaginator = array();
            if (count($markets) > 0) {
                $articleArr = array();
                if (count($articleObj) > 0) {
                    foreach ($articleObj as $articleObjkey => $article) {
                        $articleArr[$articleObjkey]['article_id'] = $article->getId();
                        $articleArr[$articleObjkey]['article_name'] = $article->getArticleName();
                        $articleArr[$articleObjkey]['editor_name'] = $article->getEditor_name();
                        $articleArr[$articleObjkey]['publication_name'] = $article->getPublication_name();
                        $articleArr[$articleObjkey]['posted_date'] = date("m/d/Y", $article->getcreationDate());
                        $articleArr[$articleObjkey]['article_desc'] = $article->getArticleDesc();
                    }
                }    
            }
            
            $this->view->markets = $markets;
            $this->view->articles = $articleArr;
        }
    }

    /**
     * Method to load more articles on AJAX load
     */
    public function articleAjaxloadAction() {
        
        $perpagerow = $this->config->pagerow;

        $productListings = array();
        $productListings = new Object\Product\Listing();
        //$currentMarket = $this->getParam('currentMarket');
        $currentMarket = preg_replace("/[^a-zA-Z0-9]/", "", str_replace(" ", "", $this->getParam('currentMarket')));

        if (null !== $this->getParam('scrollcount')) {
            //$offset = $perpagerow * $this->getParam('scrollcount');
            $scrollcount = preg_replace("/[^0-9]/", "", str_replace(" ", "", $this->_getParam('scrollcount')));
            $offset = $perpagerow * $scrollcount;
        } else {
            $offset = 0;
        }

        $articleObj = new \Pimcore\Model\Object\Article\Listing();
        if ($currentMarket != "") {
            $marketName = preg_replace("/[^a-zA-Z0-9]/", "", str_replace(" ", "", $currentMarket));
            $marketNiche = Website_Library::getMarketByKey($marketName);
            $articleObj->setCondition("article_category LIKE '%," . $marketNiche . ",%'");
        }
        $articleObj->setOrderKey("o_modificationDate");
        $articleObj->setOrder("DESC");
        $articleObj->setOffset($offset);
        $articleObj->setLimit($perpagerow);
        
        if (count($articleObj) > 0) {
            foreach ($articleObj as $articleObjkey => $article) {
                $articleArr[$articleObjkey]['article_id'] = $article->getId();
                $articleArr[$articleObjkey]['article_name'] = $article->getArticleName();
                $articleArr[$articleObjkey]['editor_name'] = $article->getEditor_name();
                $articleArr[$articleObjkey]['publication_name'] = $article->getPublication_name();
                $articleArr[$articleObjkey]['posted_date'] = date("m/d/Y", $article->getcreationDate());
                $articleArr[$articleObjkey]['article_desc'] = $article->getArticleDesc();
            }
        }
        echo json_encode(array('status' => 'ok', 'ajaxData' => $articleArr), JSON_FORCE_OBJECT);
        exit;

        //}
    }

    /**
     * Method to return all markets available
     */
    public function getAllMarketsAction() {
        $marketObj = new \Pimcore\Model\Object\Market\Listing();
        $marketObj->setOrderKey("priority");
        $marketObj->setOrder("asc");
        $marketArr = array();
        if (count($marketObj) > 0) {
            foreach ($marketObj as $marketKey => $marketObj) {
                $marketArr[$marketKey]['key'] = $marketObj->getKey();
                $marketArr[$marketKey]['name'] = $marketObj->getMarket_name();
                $marketArr[$marketKey]['id'] = $marketObj->getId();
            }
        }
        return $marketArr;
    }
    
    /**
     * Method to get all full library products with respective markets
     */
    public function fullComplianceLibraryAction() {        
        $this->enableLayout();
        $perpagerow = $this->config->pagerow;


        $productListings = array();
        $productListings = new Object\Product\Listing();

        if (null !== $this->getParam('scrollcount')) {
	    $scrollcount = preg_replace("/[^0-9]/", "", str_replace(" ", "", $this->_getParam('scrollcount')));
            $offset = $perpagerow * $scrollcount;            
            //$offset = $perpagerow * $this->getParam('scrollcount');
        } else {
            $offset = 0;
        }

        if (null !== $this->getParam('marketName')) {
            $marketName = preg_replace("/[^a-zA-Z0-9]/", "", str_replace(" ", "", $this->_getParam('marketName')));
            $marketNiche = Website_Library::getMarketByKey($marketName);
            $productListings->setCondition("prod_niche LIKE '%," . $marketNiche . ",%' AND show_on_full_library =1 ");
        } else {
            $marketName = 'All';
            $productListings->setCondition("show_on_full_library =1 ");
        }
        $productListings->setOrderKey("o_modificationDate");
        $productListings->setOrder("DESC");
        $productListings->setOffset($offset);
        $productListings->setLimit($perpagerow);

        //getting all markets
        $markets = $this->getAllMarketsAction();

        $productArr = array();
        if (count($productListings) > 0) {
            foreach ($productListings as $productListingskey => $product) { //p_r($product->getProd_niche()[0]->getMarket_name()); die;
                if ($product->getProd_niche()) { 
                    $prod_img = Website_Library::getProductImage($product->getId(), 'product-image');
                    $productArr[$productListingskey]['product_id'] = $product->getId();
                    $productArr[$productListingskey]['product_name'] = $product->getProduct_name();
                    $productArr[$productListingskey]['product_img'] = $prod_img;
                    $productArr[$productListingskey]['short_desc'] = $product->getShort_desc();
                    $productArr[$productListingskey]['market'] = $product->getProd_niche()[0]->getMarket_name();
                }
            }
        }

        $this->view->markets = $markets;
        $this->view->products = json_encode($productArr);
    }

    /**
     * Method to load more products on full library on AJAX load
     */
    public function fullComplianceLibraryAjaxloadAction() {
        $perpagerow = $this->config->pagerow;

        $productListings = array();
        $productListings = new Object\Product\Listing();
        $currentMarket = $this->getParam('currentMarket');

        if (null !== $this->getParam('scrollcount')) {
	    $scrollcount = preg_replace("/[^0-9]/", "", str_replace(" ", "", $this->_getParam('scrollcount')));
            $offset = $perpagerow * $scrollcount;            
            //$offset = $perpagerow * $this->getParam('scrollcount');
        } else {
            $offset = 0;
        }

        if ($currentMarket != "") {
            $marketName = preg_replace("/[^a-zA-Z0-9]/", "", str_replace(" ", "", $currentMarket));
            $marketNiche = Website_Library::getMarketByKey($marketName);
            $productListings->setCondition("prod_niche LIKE '%," . $marketNiche . ",%' AND show_on_full_library =1 ");
        } else {
            $marketName = 'All';
            $productListings->setCondition("show_on_full_library =1 ");
        }

        $productListings->setOrderKey("o_modificationDate");
        $productListings->setOrder("DESC");
        $productListings->setOffset($offset);
        $productListings->setLimit($perpagerow);

        if (count($productListings) > 0) {
            foreach ($productListings as $productListingskey => $product) {

                if ($product->getProd_niche()) {
                    $prod_img = Website_Library::getProductImage($product->getId(), 'product-image');
                    $productArr[$productListingskey]['product_id'] = $product->getId();
                    $productArr[$productListingskey]['product_name'] = $product->getProduct_name();
                    $productArr[$productListingskey]['product_img'] = $prod_img;
                    $productArr[$productListingskey]['short_desc'] = $product->getShort_desc();
                    $productArr[$productListingskey]['market'] = $product->getProd_niche()[0]->getMarket_name();
                }
            }
        }

        echo json_encode(array('status' => 'ok', 'ajaxData' => $productArr), JSON_FORCE_OBJECT);
        exit;
    }
}
