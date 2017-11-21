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
//use Pimcore\Model\Object\Data\ExternalImage;
use Pimcore\Model\Asset;
use Pimcore\File;
use Pimcore\Tool;

include_once (dirname(__FILE__) . "/../../Model/ProductModel.php");

use Jjkeller\Model\ProductModel;

class MigrateProduct extends CommanLib {

    public $availableField = [];
    public $csvHeader = "";
    public $csvData = [];
    public $modelObj;
    public $objectAllProductFolderId = 4533;
    public $assetAllProductCsvFolderId = 80;
    public $assetErrorProductCsvFolderId = 89;
    public $assetProcessedCsvFolderId = 264;
    public $assetProcessedProductImageFolderId = 86;
    Public $defaultImageId = 54;
    public $currentErrorFile = "";
    public $currentCsvFileName = "";
    public $errorSource = "";
    public $timeSpan = "";
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


        $totalFile = 0;
        $fileName = "";
        $logMessage = "";

        // Get list of csv file pending for process
        $list = new \Pimcore\Model\Asset\Listing();
        $list->setCondition("path='" . $pathAllProductCsv . "/' and mimetype = 'text/csv' ");
        $list->loadIdList();

        $filteredNisFieldsIndex1 = array();
        foreach ($list as $a) {
            $totalRowPassed = 0;
            $totalRowFailed = 0;
            $totalFile++;
            $csvFile = PIMCORE_ASSET_DIRECTORY . $pathAllProductCsv . "/" . $a->getFilename();
            $this->currentCsvFileName = $a->getFilename();
            $this->timeSpan = date("Ymd_his"); //time();
            $this->currentErrorFile = \Pimcore_File::getValidFilename(str_replace(".csv", "-error-" . $this->timeSpan . ".csv", $this->currentCsvFileName));



            $file = fopen($csvFile, "r");
            $i = 0;
            $k1 = 0;

            //$header = '';
            echo "Start File reading....\n";
            while (($row = fgetcsv($file, 0, ",")) !== false) {
                if ($i == 0) {
                    $this->csvHeader = $row;
                    foreach ($row as $k => $v) {
                        $v = ucwords(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $v));
                        if (in_array($v, array_keys($nisFieldArr))) {
                            $filteredNisFieldsIndex1[$k] = $nisFieldArr[ucwords($v)]; //array( $nisFieldArr['pimcore_attr_name'],);
                        }
                    }
                } else {
                    $k1 ++;
                    if ($this->processCsvData($row, $className, $filteredNisFieldsIndex1)) {
                        echo " $k1 : Done \n";
                        $totalRowPassed++;
                    } else {
                        echo " $k1 : Fail \n";
                        $totalRowFailed++;
                    }
                }
                $i ++;
             }
            $logMessage .= "\n fileName- " . $this->currentCsvFileName . ", totalPassed- " . $totalRowPassed . ", totalFailed- " . $totalRowFailed;

            \Pimcore\Model\Version::disable();
            $Asset = Asset::getByPath($pathAllProductCsv . "/" . $a->getFilename());
            $newParent = Asset::getById($idProcessedCsvFolder);
            $backupFileName = \Pimcore_File::getValidFilename(str_replace(".csv", "-" . $this->timeSpan . ".csv", $a->getFilename()));

            $Asset->setFilename($backupFileName);
            $Asset->setParent($newParent);
            $Asset->save();
            \Pimcore\Model\Version::enable();
        }
        $logMessage = "Total number of csv file- $totalFile ,\n" . $logMessage;

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

    /**
     * Get the class defination
     */
    public function getClassDefination($className) {
        try {
            $supportedFieldTypes = array(
                "checkbox",
                "country",
                "date",
                "datetime",
                "href",
                "externalImage",
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
                    } 

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

    public function processCsvData($row, $srtClassName, $filteredNisFieldsIndex1) {
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
                    } elseif ($methodName == "setProduct_img") {
                        // No action taken here
                    } elseif ($methodName == "setExternal_img") {
                        $externalImageUrl = $value;
                        // Set external image url
                        if ($actionMsg == "Update") {
                            $objClass->getExternal_img()->setUrl($value);
                        } else {
                            // Create a External Image instance and attach it
                            $a = new \Pimcore\Model\Object\Data\ExternalImage($url);
                            $objClass->setExternal_img($a);
                        }
                    } elseif ($methodName == "setShow_subhead") {
                        $boolVal = ($value == 0) ? 0 : 1;
                        $objClass->$methodName($value);
                    } elseif ($methodName == "setShow_on_publication") {
                        $boolVal = ($value == 0) ? 0 : 1;
                        $objClass->$methodName($value);
                    } elseif ($methodName == "setShow_on_full_library") {
                        $boolVal = ($value == 0) ? 0 : 1;
                        $objClass->$methodName($value);
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
                //$objAssets->getPath()
            } else {
                //Set default image if image not found
               
                $prod_img_src = \Pimcore\Tool\Frontend::getWebsiteConfig()->defaultProductImage;
                $objAssets = Asset::getByPath($prod_img_src); 
            }

            //Set Prodcut image
            $objClass->setProduct_img($objAssets);

            $key = \Pimcore\File::getValidFilename($key);
            $objClass->setParentId($this->objectAllProductFolderId);
            $objClass->setPublished(true);
            $objClass->setKey($key);

            // Save Object 
            $objClass->save();

            // Insert External image url
            if ($actionMsg == "Insert") {
                $objClass->getExternal_img()->setUrl($externalImageUrl);
                $objClass->save();
            }

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
            // Add error msg in last column.
            //array_push($row, $e->getMessage());
            $this->captureErrorRow($row,$filteredNisFieldsIndex1,$e->getMessage());
            return false;
        }
    }

    /**
     * Log the Information
     * string $str 
     */
    public function captureDataLog($logType = '', $str, $srtClassName) {
        $this->isError = TRUE;
        \Pimcore\Log\Simple::log($srtClassName . "_log_" . date("Ymd"), $str);
        \Pimcore\Log\Simple::log($srtClassName . "_log_" . date("Ymd"), "\t\t============== $this->timeSpan ===============\n");

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
    public function captureErrorRow($row = array(), $filteredNisFieldsIndex1=array(),$errorMsg='') {
        $errorProductFolder = Asset::getById($this->assetErrorProductCsvFolderId);
        $errorProductFilePath = PIMCORE_ASSET_DIRECTORY . $errorProductFolder . "/" . $this->currentErrorFile;

        $objErrorFile = Asset::getByPath($errorProductFilePath);
        if (!($objErrorFile instanceof \Pimcore\Model\Asset)) {
            echo "error file- created";
            //Create csv error file for logging
            $this->createErrorFile($this->currentErrorFile);
        } else {
            echo "error file- Already exist";
        }

        // Handle blank value in row
        $rowData = array();
        foreach($filteredNisFieldsIndex1 as $key=>$val){
           if($row[$key]=='')
                $row[$key]="";
        }
        ksort($row);
        
        // Add error message in esv
        array_push($row, $errorMsg);

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
                if ($this->checkAssetsForImageType($asset)) {
                    $image = $asset->getId();
                } else {
                    $image = "";
                }
            }
        }
        return $image;
    }

    /*
     * Check Assets for image type
     */
    public function checkAssetsForImageType($objAssets=""){
       echo  $filePath =  PIMCORE_ASSET_DIRECTORY .$objAssets->getPath().$objAssets->getFilename();    
        if(exif_imagetype($filePath)) {
            return 1;
        }else{
            return 0;
        }
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
            $errorProductFolder = Asset::getById($this->assetErrorProductCsvFolderId);
            $errorProductFilePath = PIMCORE_ASSET_DIRECTORY . $errorProductFolder . "/" . $this->currentErrorFile;

            //Check if file already exits
            if (!file_exists($errorProductFilePath)) {
                $document = Asset\Document::create(
                                $this->assetErrorProductCsvFolderId, array(
                            "fileName" => $this->currentErrorFile,
                            "Data" =>  implode(",",$this->csvHeader).",Error\n",//file_get_contents($this->errorSource),
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