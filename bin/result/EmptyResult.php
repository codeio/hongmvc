<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

class EmptyResult extends ActionResult
{
    public function execute($controllerContext) {
        
    }
}

?>