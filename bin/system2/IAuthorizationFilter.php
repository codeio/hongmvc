<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

interface IAuthorizationFilter
{
    public function authorization($filterContext);
}

?>