<?php

/**
 * This is to process the category information 
 * @author Tarun
 */

namespace Jjkeller\Lib\Product;

include_once (dirname(__FILE__) . "/../CommanLib.php");

use Jjkeller\Lib\CommanLib;
use Pimcore\Model\Object;
use Pimcore\Model\Object\ClassDefinition;
use Pimcore\Model\Object\Product;
use Pimcore\Model\Asset;
use Pimcore\File;
use Pimcore\Tool;

include_once (dirname(__FILE__) . "/../../Model/ProductModel.php");

use Jjkeller\Model\ProductModel;

class MigrateProduct extends CommanLib {

    public $availableField = [];
    public $header;
    public $csvData = [];
    public $modelObj;
    
    public $objectAllProductFolderId = 310;
    public $assetAllProductCsvFolderId = 80;
    public $assetErrorProductCsvFolderId = 89;
    public $assetProcessedCsvFolderId = 81;
    public $assetProcessedProductImageFolderId = 86;
    Public $defaultImageId = 54;
    
    public $currentErrorFile = "";
    public $currentCsvFileName = "";
    public $errorSource = "";

    Public $notifecationEmail = "ashutosh.misra@osscube.com";
    Public $isError = false;

    public function __construct() {
        parent::__construct();
        $this->modelObj = new ProductModel();
        $this->errorSource = PIMCORE_PLUGINS_PATH . '/Jjkeller/static/error.csv';
    }

    /**
     * Import start from here
     */
    public function ProductImport() {
        // Create prerequisit for Product
        $className = "Product";
        $classProductAtr = $this->getClassDefination($className);
        $nisFieldArr = $this->getNisFieldName($classProductAtr);
        $nisFieldKey = array_keys($nisFieldArr);
        
        $idAllProductCsvFolder = $this->assetAllProductCsvFolderId;
        $idProcessedCsvFolder = $this->assetProcessedCsvFolderId;
        $pathAllProductCsv = Asset::getById($idAllProductCsvFolder);
        $pathProcessedCsv = Asset::getById($idProcessedCsvFolder);
        
        
        $totalFile=0;
        $fileName="";
        $logMessage = "";    
        
        // Get list of csv file pending for process
        $list = new \Pimcore\Model\Asset\Listing();
        $list->setCondition("path='" . $pathAllProductCsv . "/'");
        $list->loadIdList();
        
        $filteredNisFieldsIndex1 = array();
        foreach ($list as $a) {
            $totalRowPassed=0;
            $totalRowFailed=0;
            $totalFile++;
            $csvFile = PIMCORE_ASSET_DIRECTORY . $pathAllProductCsv . "/" . $a->getFilename();
            $this->currentCsvFileName = $a->getFilename();
            

            $file = fopen($csvFile, "r");
            $i = 0;
            $k1 = 0;

            $header = '';
            echo "Start File reading....\n";
            while (($row = fgetcsv($file, 0, ",")) !== false) {
                if ($i == 0) {
                    foreach ($row as $k => $v) {
                        $v = ucwords(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $v));
                        if (in_array($v, array_keys($nisFieldArr))) {
                            $filteredNisFieldsIndex1[$k] = $nisFieldArr[ucwords($v)]; //array( $nisFieldArr['pimcore_attr_name'],);
                        }
                    }
                } else {
                    $k1 ++;
                    if ($this->processCsvData($row, $className, $filteredNisFieldsIndex1, $filteredNisFieldsIndex2)){
                        echo " $k1 : Done \n";
                    $totalRowPassed++;
                    }else {
                        echo " $k1 : Fail \n";
                        $totalRowFailed++;
                    }
                }
                $i ++;
                // if($k1==3) die;
            }
            $logMessage .= "\n fileName- ".$this->currentCsvFileName.", totalPassed- ".$totalRowPassed.", totalFailed- ".$totalRowFailed;
            
            fclose($file);
            \Pimcore\Model\Version::disable();
            $Asset = Asset::getByPath($pathAllProductCsv . "/" . $a->getFilename());
            $newParent = Asset::getById($idProcessedCsvFolder);
            $backupFileName =   \Pimcore_File::getValidFilename(str_replace(".csv", "-".date("Ymd-His").".csv", $a->getFilename()));
            
            $Asset->setFilename($backupFileName);
            $Asset->setParent($newParent);
            $Asset->save();
            \Pimcore\Model\Version::enable();
        }
        $logMessage = "Total number of csv file- $totalFile ,\n".$logMessage;
        
        $this->captureDataLog('info', $logMessage, $className);
        
        return $responce = array(
            "message" => "Import Done",
            "logMsg" => $logMessage,
            "success" => true
        );
    }

    public function getNisFieldName($classAtr) {
        try {
            $classAttrKey = " '" . implode("','", array_keys($classAtr)) . "' ";
            $catPimId = $this->modelObj->getNisFieldName($classAttrKey);
            // p_r($catPimId); die;
            $nisFieldArr = array();
            foreach ($catPimId as $k => $v) {

                $nisFieldArr[ucwords(trim($v['jjkeller_col_name']))]['pimcore_attr_name'] = ucwords(trim($v['pimcore_attr_name']));
                $nisFieldArr[ucwords(trim($v['jjkeller_col_name']))]['localized'] = $v['localized'];
                $nisFieldArr[ucwords(trim($v['jjkeller_col_name']))]['key_name'] = $v['key_name'];
            }

            return $nisFieldArr;
        } catch (\Exception $e) {
            // Log the action
            $str = "\n Error- Class- $srtClassName, Function- getNisFieldName(),  " . $e->getMessage();
            $this->captureDataLog('error', $str, $srtClassName);
            return FALSE;
        }
    }

//    /**
//     * Get the class defination
//     */
    public function getClassDefination($className) {
        try {
            $supportedFieldTypes = array(
                "checkbox",
                "country",
                "date",
                "datetime",
                "href",
                "externalimage",
                "image",
                "input",
                "language",
                "table",
                "multiselect",
                "numeric",
                "password",
                "select",
                "slider",
                "textarea",
                "wysiwyg",
                "objects",
                "multihref",
                "geopoint",
                "geopolygon",
                "geobounds",
                "link",
                "user",
                "email",
                "gender",
                "firstname",
                "lastname",
                "newsletterActive",
                "newsletterConfirmed",
                "countrymultiselect",
                "objectsMetadata",
                "localizedfields"
            );

            $classAttr = array();
            // get class data
            $class = ClassDefinition::getByName($className);
            $fields = $class->getFieldDefinitions();

            foreach ($fields as $key => $field) {
                $config = null;
                $title = $field->getName();
                if (method_exists($field, "getTitle")) {
                    if ($field->getTitle()) {
                        $title = $field->getTitle();
                    }
                }

                if (in_array($field->getFieldType(), $supportedFieldTypes)) {
                    if ($field->getFieldType() == "localizedfields") {
                        $localField = $field->getFieldDefinitions();
                        foreach ($localField as $fieldName => $elDetail) {
                            $title = $elDetail->getTitle();
                            if ($fieldName != 'localizedfields') {
                                $this->availableField[$title] = $fieldName;
                            }
                        }
                    } // End

                    if ($field->getName() != 'localizedfields') {
                        $this->availableField[$title] = $field->getName();
                    }
                }
            }
            return $this->availableField;
        } catch (\Exception $e) {
            // Log the action
            $str = "\n Error- Class- $srtClassName,Function- getClassDefination(),   " . $e->getMessage();
            $this->captureDataLog('error', $str, $srtClassName);
            return FALSE;
        }
    }

/*
 * Process row data to import
 */
    public function processCsvData($row, $srtClassName, $filteredNisFieldsIndex1, $filteredNisFieldsIndex2) {
        //check for empty row and skeep it
        $row = array_filter($row);
        if (empty($row)) {
            return true;
        }
        
        
        try {
            \Pimcore\Model\Version::disable();
            $keyName = '';
            $keyCode = '';

            $currentProductCode = "";
            foreach ($filteredNisFieldsIndex1 as $k1 => $val1) {
                $methodName = $this->getClassFunctionName($val1['key_name']);
                if ($methodName == "setProduct_code") {
                    $currentProductCode = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row[$k1]);
                    ;
                }
            }

            if ($currentProductCode != '') {
                $objProducts = $this->getProductObjectByProductCode($currentProductCode);
                if ($objProducts instanceof \Pimcore\Model\Object\Product) {
                      $actionMsg = "Update";
                      $objClass = $objProducts;
                } else {
                        $actionMsg = "Insert";
                    $objClass = new Product();
                }
            }
            
            //Start- Get method for mapped column and set the value
            $classMethods = get_class_methods($objClass);
            foreach ($filteredNisFieldsIndex1 as $k => $val) {
                $methodName = $this->getClassFunctionName($val['key_name']);
                if (in_array($methodName, $classMethods)) {
                    $value = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row[$k]);
                    if ($methodName == "setProd_niche") {
                        $objMarket = $this->getMarketByNicheCode($value);
                        $objClass->setProd_niche($objMarket);
                    } elseif ($methodName == "setShow_description" || $methodName == "getShow_on_publication" || $methodName == "getShow_on_full_library") {
                        $objClass->$methodName(true);
                    } else {
                        $objClass->$methodName($value);
                    }
                }
                $keyName .= ($methodName == 'setProduct_name') ? $value : '';
                $keyCode .= ($methodName == 'setProduct_code') ? $value : '';
            }
            //End- Get method for mapped column and set the value
            
            // Build product key
            $key = $keyName . '-' . $keyCode;

            //Get Assets object
            $assetsId = $this->getProductImageByProductCode($objClass->getProduct_code());
            
            if ($assetsId != "") {
                //Set Image for product
                $objAssets = Asset::getById($assetsId);
            } else {
                //Set default image if image not found
                $objAssets = Asset::getById($this->defaultImageId);
            }

            //Set Prodcut image
            $objClass->setProduct_img($objAssets);

            $key = \Pimcore\File::getValidFilename($key);
            $objClass->setParentId($this->objectAllProductFolderId);
            $objClass->setPublished(true);
            $objClass->setKey($key);
            // Save Object 
            $objClass->save();

            //Change Image folder
            // Move image only when it is exist in source folde
            if ($assetsId != "") {
                $objAssets->setParentId($this->assetProcessedProductImageFolderId);
            }
            $objAssets->save();

            $pimId = $objClass->getId();
            $str = "\n ProductId-$pimId, Action- $actionMsg";
            // Log the action
            $this->captureDataLog('info', $str, $srtClassName);
            \Pimcore\Model\Version::enable();
            return true;
        } catch (\Exception $e) {
            // Log the action
            $value = implode(",  ", $row);
            $value = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $value);
            $str = "\n Error- Class- $srtClassName, value=($value) " . $e->getMessage();
            $this->captureDataLog('error', $str, $srtClassName);

            // Insert row in error file
            $this->captureErrorRow($row);
            return false;
        }
    }

    /**
     * Log the Information
     * string $str 
     */
    public function captureDataLog($logType = '', $str, $srtClassName) {
        $this->isError = TRUE;
        \Pimcore\Log\Simple::log($srtClassName . "_log_".date("Ymd"), $str);
        \Pimcore\Log\Simple::log($srtClassName . "_log_".date("Ymd"), "\t\t=============================\n");
       
        // Send notifecation mail
        //$this->sendNotifecationMail($str, $srtClassName);
        
        $logger = \Pimcore\Log\ApplicationLogger::getInstance("Noon Plugin - Product import", true); // returns a PSR-3 compatible logger
        if ($logType == 'error') {
            $logger->error($str);
        }
        if ($logType == 'alert') {
            $logger->alert($str);
        }
        if ($logType == 'emer') {
            $logger->emergency($str);
        }
        if ($logType == 'info') {
            $logger->log('info', $str);
        }
    }

    /**
     * Log the Information
     * string $str 
     */
    public function captureErrorRow($row = array()) {

        $errorProductFolder = Asset::getById($this->assetErrorProductCsvFolderId);
        $this->currentErrorFile = \Pimcore_File::getValidFilename(str_replace(".csv", "-error.csv", $this->currentCsvFileName));
        $errorProductFilePath = PIMCORE_ASSET_DIRECTORY . $errorProductFolder . "/" . $this->currentErrorFile;
        
        $objErrorFile = Asset::getByPath($errorProductFilePath);
         if (!($objErrorFile instanceof \Pimcore\Model\Asset)) {
             echo "error file- created";
             //Create csv error file for logging
             $this->createErrorFile($this->currentCsvFileName);
         }else{
              echo "error file- Already exist";
         }
         
        $file = fopen($errorProductFilePath, "a+");
        fputcsv($file, $row, ",");
        fclose($file);
        
    }

    /*
     * Send Notifecation mail
     */
    public function sendNotifecationMail($msg = "", $srtClassName = "") {// sending a text-mail
        $mail = new \Pimcore\Mail();
        $mail->addTo($this->notifecationEmail);
        //$mail->setSubject("Product import notifecation");
        $mail->setBodyText($msg);
        if ($mail->send()) {
            $str = "\n Product import notifecation mail ";
            $this->captureDataLog('info', $str, $srtClassName);
        } else {
            $str = "\n Product import notifecation mail failed";
            $this->captureDataLog('info', $str, $srtClassName);
        }
    }

    /*
     * Return build function name for key_name entered in tblPimcoreJjkellerMapping 
     */
    public function getClassFunctionName($name) {
        $search = array(' ', '/');
        $replace = array('', 'or');
        return $methodName = "set" . ucwords(str_replace($search, $replace, $name));
    }

    /*
     * Return Market object for Niche code
     */
    public function getMarketByNicheCode($value) {
        $marketObj = new \Pimcore\Model\Object\Market\Listing();
        $marketObj->setCondition("niche_code Like ?", "%,$value,%");
        $marketObj->loadIdList();
        $oSubProd = array();
        foreach ($marketObj as $marketKey => $marketObj) {
            $oSubProd[] = Object::getById($marketObj->getId());
        }
        return $oSubProd;
    }

    /*
     * Return Return product image for Product code
     */
    public function getProductImageByProductCode($productCode) {
        $list = new \Pimcore\Model\Asset\Listing();
        $list->setCondition("path LIKE ?", "%image%");
        $list->setCondition("path LIKE ? AND filename LIKE ?", ["%/all-product-images/%", $productCode . ".%"]);
        $list->load();
        if (count($list) > 0) {
            foreach ($list as $asset) {
                $image = $asset->getId();
            }
        }
        return $image;
    }

    /*
     * Return Market object for Niche code
     */
    public function getProductObjectByProductCode($productCode) {
        $productObj = new \Pimcore\Model\Object\Product\Listing();
        $productObj->setCondition("product_code Like ?", $productCode);
        $productObj->load();
        $objProduct = array();
        foreach ($productObj as $prodKey => $prodObj) {
            $objProduct = Object::getById($prodObj->getId());
        }
        return $objProduct;
    }

    /*
     * Create error file to store product detail having error
     */
    public function createErrorFile($filename) {
        try {
            $filename = $this->currentErrorFile;
            //$this->currentErrorFile = \Pimcore_File::getValidFilename(str_replace(".csv", "-error.csv", $filename));
            $errorProductFilePath = PIMCORE_ASSET_DIRECTORY . $errorProductFolder . "/" . $this->currentErrorFile;

            //Check if file already exits
            if (!file_exists($errorProductFilePath)) {
                $document = Asset\Document::create(
                                $this->assetErrorProductCsvFolderId, array(
                            "fileName" => $this->currentErrorFile,
                            "Data" => file_get_contents($this->errorSource),
                            "userOwner" => 1,
                            "userModification" => 1
                                )
                );
                $document->save();
            }
        } catch (\Exception $e) {
            $str = $e->getMessage();
            $this->captureDataLog('error', $str, "");
        }
    }

}

?>