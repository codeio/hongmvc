<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

class ContentResult extends ActionResult
{
    
    public $content = '';
    
    public function __construct($content) {
        $this->content = $content;
    }

    public function execute($controllerContext) {
        echo $this->content;
    }
}

?>