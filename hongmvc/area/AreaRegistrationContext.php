<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

abstract class ActionResult
{
    public abstract function execute($controllerContext);
}

?>