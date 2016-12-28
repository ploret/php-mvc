<?php
/*
 * Routing for MVC pattern
*/
require_once APPLICATION . 'config.php';
require_once CORE . 'Controller.php';

class Route {
    public $controller = NULL;
    public $method = 'index';
    public $parameters = NULL;
    public $url = NULL;
    public $segments = NULL;


    /**
     * Set $this->controller and $this->method
     * @author Maxim Shiryaev
     * @return null
     */
    public function __construct() {
        $this->controller = ROUTE_DEFAULT_CONTROLLER;
        $this->segments = $this->strip();
        if (isset($this->segments[0]) && $this->segments[0] != NULL) {
            $this->controller = $this->segments[0];
        }
        if (isset($this->segments[1]) && $this->segments[1] != NULL) {
            $this->method = $this->segments[1];
        }
        $this->get($this->controller, $this->method, APPLICATION . 'mvc/controllers/' . $this->controller . '.php');
    }

    
    /**
     * Set $this->controller and $this->method
     * @author Maxim Shiryaev
     * @param string $controller - controller class
     * @param string $method - method class
     * @param string $path - filepath
     * @return null
     */
    public function get($controller, $method, $path) {
        if (file_exists($path)) {
            require_once($path);
            if (is_subclass_of($controller, 'Controller')) {
                $baseController = new Controller();
                $controller = new $controller();
            }
            $method = strtok($method, '?');
            if (method_exists($controller, $method)) {
                $parameters = new ReflectionMethod($controller, $method);
                $segments = count($this->segments) - 2;
                if ($segments < 0) {
                        $segments = 0;
                }
                call_user_func_array(array($controller, $method), array_splice($this->segments, 2));
            }
            else {
                echo '\'', $method, '\' method not found';
            }
        }
        else {
            echo '\'', $controller, '\' controller not found';
        }
    }

    /**
     * Parse url
     * @author Maxim Shiryaev
     * @return null
     */
    public function strip() {
        $request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : NULL;
        $script_url = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : NULL;
        if ($request_url != $script_url) {
            $index = str_replace('index.php', NULL, $script_url);
            $this->url = trim(preg_replace('/' . str_replace('/', '\/', $index) . '/', NULL, $request_url, 1), '/');
        }
        return explode('/', $this->url);
    }
}

$application = new Route();