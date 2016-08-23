<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

interface IActionFilter
{
    public function actionExecuting($filterContext);

    public function actionExecuted($filterContext);
}

?>