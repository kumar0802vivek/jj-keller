<?php
/**
 * To install the dependant classes/tables etc....
 * @author Tarun
 * @version 1.0
 */
namespace Jjkeller\Plugin;

use Pimcore\Model\Object;

class Install
{

    public $className = 'Category';

    public $userId = 0;

    public function createClass()
    {
        $class = Object\ClassDefinition::getByName($this->className);
        if (empty($class)) {
            $class = Object\ClassDefinition::create([
                'name' => $this->className,
                'userOwner' => $this->userId
            ]);
            $class->save();
        }
        
        return true;
    }

    public function importClass()
    {
        // Import class definition
        $class = Object\ClassDefinition::getByName($this->className);
        $json = file_get_contents(__DIR__ . "/../Resources/class_Category_export.json");
        $array = \Zend_Json::decode($json);
        $array['layoutDefinitions']['childs'][0]['childs'][0]['classes'] = [];
        $json = \Zend_Json::encode($array);
        $success = Object\ClassDefinition\Service::importClassDefinitionFromJson($class, $json);
        return true;
    }

    /**
     * Create Plugin dependent table
     *
     * @return boolean
     */
    public function createTables()
    {
        $db = \Pimcore\Resource\Mysql::get();
        
        $table1 = "CREATE TABLE IF NOT EXISTS `tblCategoryHierarchy` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `cat_id` varchar(50) DEFAULT NULL,
                      `cat_parent_id` varchar(50) DEFAULT NULL,
                      `pim_id` int(11) DEFAULT NULL,
                      `code_type` varchar(45) DEFAULT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ";
        $db->query($table1);
        
        return true;
    }
}
?>