<?php
/*
 * Class for loading views files. Can load view and set parameters
*/
class Load {
    
    /**
     * Load view
     * @author Maxim Shiryaev
     * @param $file string - view filename
     * @param array $data - array of variables, they can be used in view
     * @return null
     */
    public static function view($file, $data = NULL) {
        if ($data != NULL) {
                extract($data);
        }

        require_once APPLICATION . 'mvc/views/header.php';
        require_once APPLICATION . 'mvc/views/' . $file . '.php';
        require_once APPLICATION . 'mvc/views/footer.php';

    }
}