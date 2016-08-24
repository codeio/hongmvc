<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

namespace system\Web\mvc;

abstract class ActionResult
{
    public abstract function execute($controllerContext);
}

?>