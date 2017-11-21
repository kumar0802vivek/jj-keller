<?php

/**
 * This file is called directly after the pimcore startup (/pimcore/config/startup.php)
 * Here you can do some modifications before the dispatch process begins, this includes some Zend Framework plugins
 * or some other things which should be done before the initialization of pimcore is completed, below are some examples.
 * IMPORTANT: Please rename this file to startup.php to use it!
 */
/*
  // register a custom ZF controller plugin
  $front = \Zend_Controller_Front::getInstance();
  $front->registerPlugin(new Website\Controller\Plugin\Custom(), 700);
 */

/*
  // register a custom ZF route
  $router = $front->getRouter();
  $routeCustom = new \Zend_Controller_Router_Route(
  'custom/:controller/:action/*',
  array(
  'module' => 'custom',
  "controller" => "index",
  "action" => "index"
  )
  );
  $router->addRoute('custom', $routeCustom);
  $front->setRouter($router);
 */

/*
  // add a custom module directory
  $front = \Zend_Controller_Front::getInstance();
  $front->addModuleDirectory(PIMCORE_DOCUMENT_ROOT . "/customModuleDirectory");

  // add some custom events
  \Pimcore::getEventManager()->attach("object.postUpdate", function (\Zend_EventManager_Event $event) {
  $object = $event->getTarget();
  // do something ...
  // get a parameter from the event
  $saveVersionOnly = $event->getParam("saveVersionOnly");
  // ...
  });

  // do some dependency injection magic
  \Pimcore::getDiContainer()->set("foo", "bar");

 */



//\Pimcore::getEventManager()->attach("object.preUpdate", function ($event) {
//    $object = $event->getTarget();
//    
//    //Code to check Unique product code for every object while saving the product.
//    if ($object instanceof Pimcore\Model\Object\Product) {
//        $productCode = $object->getProduct_code();
//        $productId = $object->getId();
//        // $productCodeArr = array();
//        $products = new Object\Product\Listing();
//        $products->setCondition("o_id != ?  AND product_code = ?", [$productId, $productCode]);
//        if (count($products) >= 1) {
//            throw new \Pimcore\Model\Element\ValidationException(Zend_Registry::get('Zend_Translate')->translate('product.uniquecode.error'));
//        }
//    }
//
//    //Code to check Unique Market Niche code for every object while creating/updating the Market Object.
//    if ($object instanceof Pimcore\Model\Object\Market) {
//        //Niche code of current object
//        $nicheCode = $object->getNiche_code(); 
//        $marketId = $object->getId();
//        $markets = new Object\Market\Listing();
//        $markets->setCondition("o_id != ? ", $marketId);
//        $nicheMultiArr = array();
//        $nicheValArr = array();
//        if($markets){
//            //Array of all niche code from db 
//            foreach ($markets as $market) {
//                $nicheMultiValArr = $market->getNiche_code();
//                foreach($nicheMultiValArr as $nicheMultiVal){
//                    $nicheValArr[] = $nicheMultiVal;
//                }
//            }
//             //If same niche code already present in db then throw exception 
//            foreach ($nicheCode as $niche) {
//                if (in_array($niche, $nicheValArr)) {
//                    throw new \Pimcore\Model\Element\ValidationException($niche.': '.Zend_Registry::get('Zend_Translate')->translate('market.multi.nichecode'));
//                }
//            }
//        }
//    }
//
//    //Code to check the Unique Market Priority while creating/updating the Market
//    if ($object instanceof Pimcore\Model\Object\Market) {
//        $priority = $object->getPriority();
//        $marketId = $object->getId();
//        $markets = new Object\Market\Listing();
//        $markets->setCondition("o_id != ?  AND priority = ? AND priority != ?", [$marketId, $priority, '']);
//        if (count($markets) >= 1) {
//            throw new \Pimcore\Model\Element\ValidationException(Zend_Registry::get('Zend_Translate')->translate('market.priority.error'));
//        }
//    }
//});




