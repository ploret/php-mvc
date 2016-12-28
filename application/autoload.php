<?php
/*
* autoload all models
*/
function __autoload($className) {  
    if ( is_file(APPLICATION . 'mvc/models/' . $className . '.php') ) {
        require_once APPLICATION . 'mvc/models/' . $className . '.php';
    }
    else {
        throw new Exception("Class was not found");
    }
}

