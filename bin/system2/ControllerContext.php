<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

class ControllerContext
{
    public $template = null;

    public $route = array();
    
    public function __construct($template, $route) {
        $this->template = $template;
        $this->route = $route;
    }
}

?>