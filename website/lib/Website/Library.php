<?php

class Website_Library {

    //Function to check the external image URL existence

    public static function checkIfImageExists($url = '') {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (curl_exec($ch) !== FALSE) {
            // If URL is valid then check URL should only be image type
            if (@getimagesize($url)) {
                return true;
            }
        } else {
            return false;
        }
    }

    //Function to check whether internal or external image is available

    public static function getProductImage($productId = '', $thumbnail = '') {
        $product = \Pimcore\Model\Object\Product::getById($productId, true);
        $productImage = '';
        if ($product) {
            if ($product->getExternal_img()->url != '') {
                $isImgExists = self::checkIfImageExists($product->getExternal_img()->url);
                if ($isImgExists) {
                    $productImage = "<img src='" . $product->getExternal_img()->url . "' class='responsive' />";
                } else {
                    $productImage = self::checkProductImage($product, $thumbnail);
                }
            } else {
                $productImage = self::checkProductImage($product, $thumbnail);
            }
        }
        return $productImage;
    }

    //Function to check whether internal image is available or not

    public static function checkProductImage($product = '', $thumbnail = '') {
        if (count($product->getProduct_img()) > 0) {
            $prod_img_src = $product->getProduct_img()->getPath() . $product->getProduct_img()->getFilename();
            $asset = Asset::getByPath($prod_img_src);
            $productImage = $asset->getThumbnail($thumbnail)->getHTML();
        } else {
            $prod_img_src = Pimcore\Tool\Frontend::getWebsiteConfig()->defaultProductImage;
            $asset = Asset::getByPath($prod_img_src);
            $productImage = $asset->getThumbnail($thumbnail)->getHTML();
        }
        return $productImage;
    }
    
    public static function getMarketByKey($marketKey = '') { //die($marketKey);
        if($marketKey !== '' && $marketKey != 'All') {
            $marketObject = new Object\Market\Listing();
            $marketObject->setCondition("o_key = '".$marketKey."'");
            $results = $marketObject->load();
            if(count($results) > 0) {
                return $results[0]->getId();
            }             
        } else {
            return null;
        }
        
    }

}
?>