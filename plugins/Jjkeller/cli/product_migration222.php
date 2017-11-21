<?php

/**
 * This is to migrate the GPC category into pimcore
 * @author Tarun
 */
use Jjkeller\Lib\Product\MigrateProduct;

include_once (dirname(__FILE__) . "/../../../pimcore/cli/startup.php");

$pObj = new MigrateProduct();

// Create prerequisit for Product
$className2="Product";
$classAtr2 = $pObj->getClassDefination($className2);
$nisFieldArr2 = $pObj->getNisFieldName($classAtr2);
$nisFieldKey2= array_keys($nisFieldArr2);
$filteredNisFields2= array();


// Get csv file from Assets->products folder
$list = new \Pimcore\Model\Asset\Listing();
$list->setCondition("path='/products/'");
$list->loadIdList();

foreach ($list as $a) {

    $csvFile = PIMCORE_ASSET_DIRECTORY . "/products/" . $a->getFilename(); 
    $file = fopen($csvFile, "r");
    $i = 0;
    $k1 = 0;
    $header = '';
    echo "Start File reading....\n";
    while (($row = fgetcsv($file, 0, "\t")) !== false) {
        
        if ($i == 0) {
            foreach($row as $k=>$v){
                $v = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $v);
                if(in_array($v, array_keys($nisFieldArr1))){
                   $filteredNisFieldsIndex1[$k]= $nisFieldArr1[$v];//array( $nisFieldArr['pimcore_attr_name'],);
                }
            }
        } else {
            $k1 ++;
            if($pObj->processCsvData($row, $className1, $filteredNisFieldsIndex1, $filteredNisFieldsIndex2))
                echo " $k1 : Done \n";
            else{
               echo " $k1 : Fail \n";  
            }
        }
        $i ++;
       // if($k1==3) die;
    }
    fclose($file);
    die("First File executed");
}
?>