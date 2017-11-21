<?php
/**
 * This is to set global settings
 * @author Tarun
 */

namespace Jjkeller\Lib;

class CommanLib {
    
    public function __construct() {
        \Pimcore\Model\Version::disable();
        \Pimcore\Cache::disable();
    }
    
}
?>