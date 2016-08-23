<?php
if(!defined('IN_HONG')) {
    exit('Access Denied');
}

class Home extends Controller {

	function __construct() {
        Server::loadSysClass('Pager');
        Server::loadSysFunc('Pager');
        
        Server::loadClass('Pager');
        Server::loadFunc('Pager');
        
        Server::loadModel('member');
        Server::loadService('member');
	}
    
    function index() {
        return $this->view();
    }
    
    function indexPost() {
        return $this->view();
    }
    
    function json() {
        return $this->json();
    }
}

?>