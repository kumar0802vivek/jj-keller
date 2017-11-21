<?php

namespace JJKellerEvent;

use Pimcore\API\Plugin as PluginLib;

class Plugin extends PluginLib\AbstractPlugin implements PluginLib\PluginInterface {

    protected static $_translate;

    public function init() {
        parent::init();

        //Call handleObjectEvent method
        \Pimcore::getEventManager()->attach("object.preUpdate", [$this, "handleObjectEvent"]);
        //\Pimcore::getEventManager()->attach("object.postUpdate", [$this, "handleObjectPostEvent"]);
    }

    public function handleObjectEvent(\Zend_EventManager_Event $event) {

        $object = $event->getTarget();
        //Code to check Unique product code for every object while saving the product.
        if ($object instanceof \Pimcore\Model\Object\Product) {
            $productCode = $object->getProduct_code();
            $productId = $object->getId();
            $products = new \Pimcore\Model\Object\Product\Listing();
            $products->setCondition("o_id != ?  AND product_code = ?", [$productId, $productCode]);
            if (count($products) >= 1) {
                throw new \Pimcore\Model\Element\ValidationException(self::getTranslate()->_('product.uniquecode.error'));
            }
        }

        //Code to check Unique Market Niche code for every object while creating/updating the Market Object.
        if ($object instanceof \Pimcore\Model\Object\Market) {
            //Niche code of current object
            $nicheCode = $object->getNiche_code();
            $marketId = $object->getId();
            $markets = new \Pimcore\Model\Object\Market\Listing();
            $markets->setCondition("o_id != ? ", $marketId);
            $nicheMultiArr = array();
            $nicheValArr = array();
            if ($markets) {
                //Array of all niche code from db 
                foreach ($markets as $market) {
                    $nicheMultiValArr = $market->getNiche_code();
                    foreach ($nicheMultiValArr as $nicheMultiVal) {
                        $nicheValArr[] = $nicheMultiVal;
                    }
                }
                //If same niche code already present in db then throw exception 
                foreach ($nicheCode as $niche) {
                    if (in_array($niche, $nicheValArr)) {
                        throw new \Pimcore\Model\Element\ValidationException($niche . ': ' . self::getTranslate()->_('market.multi.nichecode'));
                    }
                }
            }
        }

        //Code to check the Unique Market Priority while creating/updating the Market
        if ($object instanceof \Pimcore\Model\Object\Market) {
            $priority = $object->getPriority();
            $marketId = $object->getId();
            $markets = new \Pimcore\Model\Object\Market\Listing();
            $markets->setCondition("o_id != ?  AND priority = ? AND priority != ?", [$marketId, $priority, '']);
            if (count($markets) >= 1) {
                throw new \Pimcore\Model\Element\ValidationException(self::getTranslate()->_('market.priority.error'));
            }
        }


        // Code to find and update the product code to HTML Block
        if ($object instanceof \Pimcore\Model\Object\HtmlBlock) {
            $useCase = trim($object->getUse_case());
            if (!empty($useCase)) {
                try {
                    $db = \Pimcore\Resource::get();
                    $data = $db->prepare("SELECT product_code FROM object_query_11 WHERE $useCase");
                    $data->execute();
                    $productCodeArr = $data->fetchAll(\PDO::FETCH_COLUMN, 0);
                    if (count($productCodeArr) > 0) {
                        $productCodes = '|';
                        $productCodes .= implode("|,|", $productCodeArr);
                        $productCodes .= '|';
                        $object->setProduct_codes($productCodes);
                    }
                    else {
                        $object->setProduct_codes('');
                        //throw new \Pimcore\Model\Element\ValidationException("No Product Code found for current Use Case!");
                    }
                } catch (\Exception $e) {
                    throw new \Pimcore\Model\Element\ValidationException($e->getMessage());
                }
            } else {
               
                throw new \Pimcore\Model\Element\ValidationException(self::getTranslate()->_('htmlblock.usecase.error'));
            }
        }
    }

    public static function install() {
        // implement your own logic here
        return true;
    }

    public static function uninstall() {
        // implement your own logic here
        return true;
    }

    public static function isInstalled() {
        // implement your own logic here
        return true;
    }

    /**     * @param string $language * @return string path to the translation file relative to plugin direcory */
    public static function getTranslationFile($language) {
        if (is_file(self::getTranslationFileDirectory() . "/$language.csv")) {
            return "/JJKellerEvent/lib/JJKellerEvent/$language.csv";
        } else {
            return '/JJKellerEvent/lib/JJKellerEvent/en.csv';
        }
    }

    /**     * @return Zend_Translate */
    public static function getTranslate() {
        if (self::$_translate instanceof \Zend_Translate) {
            return self::$_translate;
        }
        $lang = 'en';
        self::$_translate = new \Zend_Translate('csv', PIMCORE_PLUGINS_PATH . self::getTranslationFile($lang), $lang, array('delimiter' => ','));
        return self::$_translate;
    }

}
