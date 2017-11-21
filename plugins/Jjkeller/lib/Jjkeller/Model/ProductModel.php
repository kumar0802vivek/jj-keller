<?php
/**
 * This is to store category information into the database
 * @author Tarun
 */
namespace Jjkeller\Model;

class ProductModel
{

    public $db = '';
    public $table = '';

    public function __construct()
    {
        $this->db = \Pimcore\Resource\Mysql::get();
        $this->table = 'tblCategoryHierarchy';
    }

    
    
    
    public function getNisFieldName($str) {
        try{
        $sql = "SELECT * FROM `tblPimcoreJjkellerMapping`  where pimcore_attr_name in ($str)";
        
         $results = $this->db->fetchAll($sql);
         return $results;
         } catch (\Exception $e) {
            // Log the action
            $str = "\n Error- Class- $srtClassName,Function- getNisFieldName(),   " . $e->getMessage();
            $this->captureDataLog('error', $str, $srtClassName);
            return FALSE;
        }
    }
}

?>