<?php

use Website\Controller\Action;

/**
 * Description of HomeController
 *
 * @author shubhamsrivastava
 */
class PublicationSectionController extends Action {

    public function init() {
        parent::init();
    }

    public function newLayoutAction() {
        $this->enableLayout();
        $promoCode = '';
        if ($this->document->getProperty('promoCode')) {
            $promoCode = $this->document->getProperty('promoCode');
        }
        $this->view->promoCode = $promoCode;
    }

    /**
     * Method to get all the publication products to show on Publication Section Page
     */
    public function publicationSectionAction() {
        $this->enableLayout();
        $condition = "show_on_publication = 1";
        $allPublicationProducts = $this->getPublicationProducts($condition);
        if (count($allPublicationProducts) > 0) {
            $this->view->productListings = $allPublicationProducts;
        }
    }

    /*
     * Added by Vivek@290Nov2016
     * Method for Publication Landing Page.
     */

    public function publicationLandingAction() {
        $this->enableLayout();
        $promoCode = '';
        if ($this->document->getProperty('promoCode')) {
            $promoCode = $this->document->getProperty('promoCode');
        }
        $this->view->promoCode = $promoCode;
    }

    /**
     * Method to get only the transport products to show on Transport Publication Page
     */
    public function transportPublicationAction() {
        $this->enableLayout();
        $marketId = 8;
        $condition = "prod_niche LIKE '%," . $marketId . ",%' AND show_on_publication = 1";
        $transportPublicationProducts = $this->getPublicationProducts($condition);
        if (count($transportPublicationProducts) > 0) {
            $this->view->productListings = $transportPublicationProducts;
        }
    }

    /*
      Added by Vivek@18Jan2017
     * Method to get only the safety products to show on Safety Publication Page
     */

    public function safetyPublicationAction() {
        $this->enableLayout();
        $marketId = 7;
        $condition = "prod_niche LIKE '%," . $marketId . ",%' AND show_on_publication = 1";
        $safetyPublicationProducts = $this->getPublicationProducts($condition);
        if (count($safetyPublicationProducts) > 0) {
            $this->view->productListings = $safetyPublicationProducts;
        }
    }

    /*
      Added by Vivek@18Jan2017
     * Method to get only the HR products to show on HR Publication Page
     */

    public function hrPublicationAction() {
        $this->enableLayout();
        $marketId = 6;
        $condition = "prod_niche LIKE '%," . $marketId . ",%' AND show_on_publication = 1";
        $hrPublicationProducts = $this->getPublicationProducts($condition);
        if (count($hrPublicationProducts) > 0) {
            $this->view->productListings = $hrPublicationProducts;
        }
    }

    /*
      Added by Vivek@18Jan2017
     * Method to get publication products as per the different condition
     */

    public function getPublicationProducts($condition = "") {
        if ($condition) {
            try {
                $productListing = new Object\Product\Listing();
                $productListing->setCondition($condition);
                $productListing->setOrderKey("o_modificationDate");
                $productListing->setOrder("desc");

                // Get the list of all the markets a/c to priority.
                $markets = $this->getAllMarketsAction();

                $finalProductArray = array();

                if (count($productListing) > 0 && count($markets) > 0) {
                    foreach ($markets as $market) {
                        foreach ($productListing as $product) {
                            if ($product->getProd_niche()[0] && !empty($product->getProduct_code())) {
                                $marketName = $product->getProd_niche()[0]->getMarket_name();
                                $productCode = $product->getProduct_code();
                                if ($marketName == $market) {
                                    $finalProductArray[$marketName][$productCode]['productName'] = $product->getProduct_name();
                                    $finalProductArray[$marketName][$productCode]['shortDesc'] = $product->getShort_desc();
                                    $productImage = Website_Library::getProductImage($product->getId(), 'publication-product');
                                    $finalProductArray[$marketName][$productCode]['productImg'] = $productImage;
                                }
                            }
                        }
                    }
                    return $finalProductArray;
                }
            } catch (Exception $e) {
                \Pimcore\Log\Simple::log('publication', $e->getMessage());
            }
        }
    }

    /*
      Added by Vivek@01Dec2016
     * Funtion to List out all the markets.
     */

    public function getAllMarketsAction() {
        $marketObj = new Object\Market\Listing();
        $marketObj->setOrderKey("priority");
        $marketObj->setOrder("asc");
        $marketArr = array();
        if (count($marketObj) > 0) {
            foreach ($marketObj as $marketKey => $marketObj) {
                $marketArr[] = $marketObj->getMarket_name();
            }
        }
        return $marketArr;
    }

}
