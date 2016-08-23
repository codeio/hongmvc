<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

class JavaScriptResult extends ActionResult
{

    public $script = '';
    
    public function __construct($script) {
        $this->script = $script;
    }

    public function execute($controllerContext) {
        header('Content-Type: application/x-javascript; charset=utf-8');
        echo $this->script;
    }
}

?>