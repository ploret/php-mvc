<?php
/*
 * Defaulf controller
 */
class Index extends Controller {

    /**
     * Load front page
     * @author Maxim Shiryaev
     * @return null
     */
    public function index() {
        Load::view('index');
    }

}