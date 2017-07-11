<?php

class HomeController extends Controller {

	function __construct() {
        
	}
    
    function index() {
        return $this->view();
    }
}

?>