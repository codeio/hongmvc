<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

interface IResultFilter
{
    public function resultExecuting($filterContext);

    public function resultExecuted($filterContext);
}

?>