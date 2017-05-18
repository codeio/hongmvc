<?php

if(!defined('IN_HONGMVC')) {
    exit('Access Denied');
}

abstract class ActionResult
{
    public abstract function execute($controllerContext);
}

?>