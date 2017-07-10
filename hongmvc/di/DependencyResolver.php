<?php

namespace hongmvc\di;

class DependencyResolver
{
	private static $_instance = null;

	private function __construct() {
		
    }

    private function __clone() {

    }

    static public function getInstance() {
    	echo print_r(self::$_instance) . '<br>';
        self::$_instance = new self();
        return self::$_instance;
    }

    public static function setResolver(IDependencyResolver $resolver) {
        //echo 111;
    }
}

?>