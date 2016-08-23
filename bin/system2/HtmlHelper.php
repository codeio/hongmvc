<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

class HtmlHelper
{
    private $_route = array();
    
    private $_view = null;

    public function __construct($route, $view) {
        $this->_route = $route;
        $this->_view = $view;
    }

    /*
    * 防止CSRF攻击的令牌
    */
    public function token() {
        $token = md5(uniqid(rand(), true));
	    $_SESSION['RequestVerificationToken']= $token;
        return "<input type='hidden' name='RequestVerificationToken' value='$token' />";
    }
    
}

?>