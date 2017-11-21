<?php

use Website\Controller\Action;
use Pimcore\Log\Simple;

/**
 * Description of HtmlBlockController
 *
 * @author Vivek
 */
class HtmlBlockController extends Action {

    public function init() {

        parent::init();
    }

    /**
     * Method to process HTML block request
     * @params string
     * @params integer
     * 
     * returns JSON
     */
    public function getHtmlBlockAction() {
        $this->disableLayout();

        //get the error message from admin translations
        $apiKeyRequired = Zend_Registry::get('Zend_Translate')->translate('webservice.apikeyrequired.error');
        $productCodeRequired = Zend_Registry::get('Zend_Translate')->translate('webservice.productcoderequired.error');
        $inValidProductCodeError = Zend_Registry::get('Zend_Translate')->translate('webservice.invalidproductcode.error');
        $apiKeyError = Zend_Registry::get('Zend_Translate')->translate('webservice.apikey.error');

        //Get the params from the URL
            $productCode = preg_replace("/[^0-9,]/", "", str_replace(" ", "", $this->getParam('productCode')));            
	    //$productCode = $this->getParam('productCode');
        if ($productCode) {
            $productCodes = explode(",", $productCode);
        }

        $apiKey = $this->getParam('apiKey');

        // error = 1 means by default error is on
        $responseArray['error'] = 1;
        $responseArray['errorMessage'] = $inValidProductCodeError;

        if (count($productCodes) > 0 && !empty($apiKey)) {
            try {
                $strWhere = "";
                foreach ($productCodes as $productCode) {
                    if (is_numeric($productCode)) {
                        if ($strWhere != '') {
                            $strWhere .= " OR product_codes like '%|" . $productCode . "|%' ";
                        } else {
                            $strWhere .= " product_codes like '%|" . $productCode . "|%' ";
                        }
                    }
                }
                if ($strWhere) {
                    $db = \Pimcore\Resource::get();
                    $query = "select oo_id,zone FROM object_10 WHERE o_published = '1' AND ($strWhere) ORDER BY priority DESC, o_modificationDate ASC";
                    $data = $db->fetchAll($query);

                    if (count($data) == 0) {
                        Simple::log('html-block-error', "Oops!! Html Block doesn't exist in system with product  $productId");
                        $responseArray['errorMessage'] = $inValidProductCodeError;
                    } else if (count($data) > 0) {
                        foreach ($data as $key => $entries) {
                            $resultSet[$entries['zone']] = $entries['oo_id'];
                        }

                        if (count($resultSet) > 0) {
                            foreach ($resultSet as $key => $result) {
                                $url = Pimcore\Tool::getHostUrl() . "/webservice/rest/object/id/" . $result . "?apikey=" . $apiKey;
                                // If API key is valid and html block is available then HIT the CURL
                                $urlResponse = self::verifyUserForHTMLBlockAction($url);
                                $responseObj = json_decode($urlResponse);
                                  
                                if (empty($responseObj)) {
                                    //If API Key is not valid
                                    Simple::log('html-block-error', "Oops!! API key " . $apiKey . " is not valid!");
                                    $responseArray['errorMessage'] = $apiKeyError;
                                } else if (!empty($responseObj) && $responseObj->success != false) {
                                    //If API key is valid
                                    unset($responseArray['errorMessage']);
                                    $responseArray['error'] = 0;
                                    $responseArray['data'][$responseObj->data->elements[1]->value] = htmlentities($responseObj->data->elements[0]->value);
                                } else if (!empty($responseObj) && $responseObj->success == false) {
                                    //API key is valid but user doesnot have access to view the html elements
                                    Simple::log('html-block-error', $responseObj->msg);
                                    $responseArray['errorMessage'] = $responseObj->msg;
                                } else {
                                    //If API Key is not valid
                                    Simple::log('html-block-error', $e->getMessage());
                                    $responseArray['errorMessage'] = $e->getMessage();
                                }
                            }
                            if (is_array($responseArray) && count($responseArray) <= 0) {
                                Simple::log('html-block-error', "Oops!! Html Block doesn't exist in system with product  $productId");
                                $responseArray['errorMessage'] = $inValidProductCodeError;
                            }
                        } else {
                            Simple::log('html-block-error', "Oops!! Html Block doesn't exist in system with product  $productId");
                            $responseArray['errorMessage'] = $inValidProductCodeError;
                        }
                    }
                } else {
                    Simple::log('html-block-error', "Oops!! Html Block doesn't exist in system with product  $productId");
                    $responseArray['errorMessage'] = $inValidProductCodeError;
                }
            } catch (\Exception $e) {
                Simple::log('html-block-error', $e->getMessage());
            }
        } else if (count($productCodes) == 0) {
            Simple::log('html-block-error', $productCodeRequired);
            $responseArray['errorMessage'] = $productCodeRequired;
        } else if (empty($apiKey)) {
            Simple::log('html-block-error', $apiKeyRequired);
            $responseArray['errorMessage'] = $apiKeyRequired;
        }
        
        echo $res = (json_encode($responseArray));
        exit;
    }

    public static function verifyUserForHTMLBlockAction($url = '') {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));

        if (curl_exec($curl) === FALSE) {
            Simple::log('html-block-error', curl_error($curl));
        } else {
            $resp = curl_exec($curl);
        }

        curl_close($curl);
        return $resp;
    }

}
