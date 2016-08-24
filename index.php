<?php

//require 'bin/HongMvc.php';
//
//HongMvc::start();

require 'hongmvc/di/IDependencyResolver.php';
require 'hongmvc/di/DefaultDependencyResolver.php';
require 'hongmvc/di/DependencyResolver.php';

use hongmvc\di\IDependencyResolver;
use hongmvc\di\DefaultDependencyResolver;
use hongmvc\di\DependencyResolver;

class AutofacDependencyResolver implements IDependencyResolver
{
    public function getService($serviceType)
    {
        return 'this is single service';
    }

    public function getServices($serviceType)
    {
        return 'this is muitl service';
    }
}

class MainDb
{
    public function test() {
        echo 'Db class test method;';
    }
}

class ContainerBuilder
{
    public function registerType($type) {
        
    }
}

class HomeController {

    private $_db;

    public function __construct(MainDb $db) {
        $this->_db = $db;
    }

    public function index() {
        //$this->_db->test();
    }

}

$container = new ContainerBuilder();

//$container->registerType('');

$resolver = new AutofacDependencyResolver();

$db = new MainDB();

$controller = new HomeController($db);

$controller->index();

$class = new ReflectionClass('HomeController');

$properties = $class->getProperties();  
foreach($properties as $property) {  
    //echo $property->getName()."\n";  
}  

$t= $class->getMethods(1);

echo var_dump($t);

//$instance  = $class->newInstanceArgs($args);

DependencyResolver::setResolver($resolver);
?>