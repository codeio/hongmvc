<?php

require 'hongmvc/start.php';

//HongMvc::start();

// require 'hongmvc/di/IDependencyResolver.php';
// require 'hongmvc/di/DefaultDependencyResolver.php';
// require 'hongmvc/di/DependencyResolver.php';

// use hongmvc\di\IDependencyResolver;
// use hongmvc\di\DefaultDependencyResolver;
// use hongmvc\di\DependencyResolver;

// class AutofacDependencyResolver implements IDependencyResolver
// {
//     public function getService($serviceType)
//     {
//         return 'this is single service';
//     }

//     public function getServices($serviceType)
//     {
//         return 'this is muitl service';
//     }
// }

// class MainDb
// {
//     public function test() {
//         echo 'Db class test method;';
//     }
// }

// class ContainerBuilder
// {
//     public function registerType($type) {

//     }
// }

// class HomeController {

//     private $_db;

//     public function __construct(MainDb $db, MainDb $db2) {
//         $this->_db = $db;
//     }

//     public function index() {
//         echo 'aaa';
//         //$this->_db->test();
//     }

// }

// $container = new ContainerBuilder();

// //$container->registerType('');

// $resolver = new AutofacDependencyResolver();

//$db = new MainDB();

//$controller = new HomeController($db, $db);

//$controller->index();

//$controllerName = 'HomeController';

//$class = new ReflectionClass($controllerName);

//$constructor = $class->getConstructor();

//$params = $constructor->getParameters();

//$paramName = $params[0]->getType()->__toString();

//$db = new $paramName;

//$controller  = $class->newInstanceArgs(array($db, $db));

//$controller->index();

//DependencyResolver::setResolver($resolver);
?>