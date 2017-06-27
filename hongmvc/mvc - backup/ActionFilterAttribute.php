<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

abstract class ActionFilterAttribute extends FilterAttribute implements IActionFilter, IResultFilter
{
    public function actionExecuting($filterContext) {}

    public function actionExecuted($filterContext) {}
    
    public function resultExecuting($filterContext) {}

    public function resultExecuted($filterContext) {}
}
?>