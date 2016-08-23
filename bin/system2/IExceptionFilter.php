<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

interface IExceptionFilter
{
    public function exception($filterContext);
}

?>