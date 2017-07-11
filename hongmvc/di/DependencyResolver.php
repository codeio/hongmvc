<?php

namespace hongmvc\di;

class DependencyResolver
{
	private static $_instance = null;
    private $resolver = null;

	private function __construct() {
		
    }

    private function __clone() {

    }

    private static function getInstance() {
        if(self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public static function getResolver() {
        return DependencyResolver::getInstance()->resolver;
    }

    public static function setResolver(IDependencyResolver $resolver) {
        DependencyResolver::getInstance()->resolver = $resolver;
    }
}

?>