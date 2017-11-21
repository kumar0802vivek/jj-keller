<?php

use Website\Controller\Action;
use Pimcore\Tool;

/**
 * Description of MarketController
 *
 * @author AshutosH
 */
class MarketController extends Action {
   
    public function init() {
        parent::init();
    }

    /**
     * Method to show category name and image on product popup
     * @param integer
     * 
     * @return string
     */
    
    public function getCategoryDetailsAction() {
        $catId = $this->_getParam('catId');
        $category = Object\Category::getById($catId);
        $asset = Asset::getByPath($category->getcat_img()->getFullPath());

        $cat_arr = array(
            'cat_name'  => $category->getcat_name(),
            'cat_key'   => $category->getKey(),
            'cat_image' => $asset->getThumbnail("category-image")->getHTML()
        );

        echo json_encode($cat_arr);
        die;
    }

    /**
     * Method to show product detail in popup 
     * @param: catId=> category Id 
     * @return: Html string as ajax response
     */
    public function categoryProductsAction() {
        $market = $this->_getParam('marketId');
        if ($this->editmode)
            $catId = 25;
        else
            $catId = $this->_getParam('catId');

        //Get products list
        $productsObject = new Object\Product\Listing();
        $productsObject->setCondition("prod_niche LIKE ? AND product_category LIKE ? AND show_on_market =? ", ["%," . $market . ",%", "%," . $catId . ",%", 1]);
        $productsObject->setOrderKey("o_creationDate");
        $productsObject->setOrder("DESC");
        // Render product list in html design
        $this->view->products = $productsObject;
        $output = $this->view->render("markets/popup.php");
        echo $output;
        exit;
    }

    /**
     * get categories atricles testimonials
     * @param: 
     * @return: Array
     */
    public function marketAction() {
        $marketId = $this->document->getProperty('marketId'); 
        $this->enableLayout();          
        // Get ARTICLES List to display in RECENT ARTICLES Block 
        $articleObj = new \Pimcore\Model\Object\Article\Listing();
        $articleObj->setCondition("article_category LIKE ?", ["%," . $marketId . ",%"]);
        $articleObj->setOrderKey("o_modificationDate");
        $articleObj->setOrder("DESC");
        $articleObj->setLimit(1);

        $arrData = array();
        foreach ($articleObj as $articleObjkey => $article) {

            $date = new Zend_Date($article->getCreationDate());
            $arrData['articleId'] = $article->getId();
            $arrData['articleName'] = $article->getArticleName();
            $arrData['publicationName'] = $article->getpublication_name();
            $arrData['editorName'] = $article->geteditor_name();
            $arrData['articleDesc'] = $article->getArticleDesc();
            $arrData['creationDate'] = $date->get('F');
            $arrData['ArticleName'] = $article->getArticleName();
        }

        // Get Testimonial List to display in Recent testimonial slider
        $testimonialListings = new \Pimcore\Model\Object\Testimonial\Listing();
        $testimonialListings->setCondition("testimonial_category LIKE ?", ["%," . $marketId . ",%"]);
        $testimonialListings->setOrderKey("o_modificationDate");
        $testimonialListings->setOrder("DESC");
        $arrTestimonials = array();

        foreach ($testimonialListings as $testimonialListingskey => $testimonial) {
            if (strlen($testimonial->getTestimonialDesc()) > 300) {
                $testimonialdesc = substr($testimonial->getTestimonialDesc(), 0, 300) . '...';
            } else {
                $testimonialdesc = $testimonial->getTestimonialDesc();
            }
            $arrTestimonials[$testimonialListingskey]['testimonial_id'] = $testimonial->getId();
            $arrTestimonials[$testimonialListingskey]['customerName'] = $testimonial->getCustomer_name();            
            $arrTestimonials[$testimonialListingskey]['testimonialDesc'] = $testimonialdesc;
            $arrTestimonials[$testimonialListingskey]['customerLocation'] = $testimonial->getCustomer_location();
        }

        // Get Category List For "Transportation" to display in Category popup
        $productsObject = new Object\Product\Listing();
        //$productsObject->setCondition("prod_niche LIKE " . $productsObject->quote("%," . $marketId . ",%"));
        $productsObject->setCondition("prod_niche LIKE ? AND show_on_market =? ", ["%," . $marketId . ",%", 1]);
        $arrCategory = array();
        $str = "";
        if (count($productsObject) > 0) {
            foreach ($productsObject as $key => $product) {
                if ($product->getprod_niche()[0] instanceof Pimcore\Model\Object\Market) {
                    if ($product->getproduct_category()[0] instanceof Pimcore\Model\Object\Category) {
                        $catId = $product->getproduct_category()[0]->getId();
                        if ($catId != '') {
                            $catName = $product->getproduct_category()[0]->getcat_name();
                        }
                        
                        if ($product->getproduct_category()[0]->getCat_img() instanceof Pimcore\Model\Asset\Image) {
                            $cat_img = $product->getproduct_category()[0]->getCat_img()->getThumbnail(["width" => 75]);
                        } else {
                            $prod_img_src = Pimcore\Tool\Frontend::getWebsiteConfig()->defaultProductImage;
                            $asset = Asset::getByPath($prod_img_src);
                            $cat_img = $asset->getThumbnail(["width" => 75]);                            
                        }
                                                $arrCategory[$catName] = array(
                            "catMarket" => $product->getprod_niche()[0]->getKey(),
                            "catMarketId" => $marketId,
                            "catId" => $catId,
                            "catName" => $product->getproduct_category()[0]->cat_name,
                            "catImg" => $cat_img,
                            "catDesc" => strip_tags($product->getproduct_category()[0]->description));
                    }
                }
            }
        }

        $marketName = $this->document->getProperty('marketName');         
        $this->view->market = $marketName;
        $this->view->categories = $arrCategory;
        $this->view->atricles = $arrData;
        $this->view->testimonials = $arrTestimonials;
    }

}
