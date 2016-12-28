<?php
/*
 * Default Controller. Use autoload.
*/
class Controller {
    
    /**
     * Autoload.
     * @author Maxim Shiryaev
     * @return null
     */
    public function __construct() {
        require_once CORE . 'Load.php';
        require_once APPLICATION . 'autoload.php';
    }

}