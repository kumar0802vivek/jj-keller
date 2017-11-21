<?php

include_once (dirname(__FILE__) . "/../lib/Jjkeller/Lib/Product/MigrateProduct.php");

use Jjkeller\Lib\Product\MigrateProduct;


class Jjkeller_IndexController extends \Pimcore\Controller\Action\Admin
{
    public function indexAction()
    {

        // reachable via http://your.domain/plugin/Jjkeller/index/index
    }
    
    /**
     * get list of objects which is in multiple promote lists.
     */
    public function startProductImportAction() {
        
        // Disable layout
        $this->disableLayout();
        
        //Create MigrateProduct objects
        $pObj = new MigrateProduct();
        $responce = $pObj->ProductImport();
        $this->_helper->json( $responce );

    }

}
