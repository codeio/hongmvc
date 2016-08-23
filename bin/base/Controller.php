<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

class Controller
{
    private $_filters = array();

    public $template = null;
    
    public $controllerContext = null;

    public function setTemplate($template) {
        $this->template = $template;
    }
 
    public function content($content) {
        return new ContentResult($content);
    }
    
    public function emptys() {
        return new EmptyResult();
    }
    
    public function file($name, $path, $type = '') {
        return new FileResult($name, $path, $type);
    }
    
    public function notFound($errorMsg = '') {
        return new HttpNotFoundResult($errorMsg);
    }
    
    public function javascript($script) {
        return new JavaScriptResult($script);
    }
    
    public function json($data) {
        return new JsonResult($data);
    }
    
    public function goto($url, $statusCode = 302) {
        return new RedirectResult($url, $statusCode);
    }
    
    public function goto_action($actionName, $data = array()) {
        return new RedirectToActionResult($actionName, $data);
    }
    
    public function view($viewName = '') {
        return new ViewResult($viewName);
    }
    
    public function assign($key, $value) {
        $this->template->assign($key, $value);
    }
    
    public function add_filter($name) {
        $key = md5($name);
        if(!isset($this->_filters[$key])) {
            $this->_filters[$key] = $name;
        }
    }
    
    public function get_filters() {
        return $this->_filters;
    }
}

?>