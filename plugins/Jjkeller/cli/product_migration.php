<?php

/**
 * This is to migrate the GPC category into pimcore
 * @author Tarun
 */
include_once (dirname(__FILE__) . "/../lib/Jjkeller/Lib/Product/MigrateProduct.php");
include_once (dirname(__FILE__) . "/../../../pimcore/cli/startup.php");

use Jjkeller\Lib\Product\MigrateProduct;
use Pimcore\Model\Asset;

//Create MigrateProduct objects
$pObj = new MigrateProduct();
$pObj->ProductImport();

die("-----Finish-----");
?>