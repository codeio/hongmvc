<?php

namespace hongmvc\web;

class RequestContext
{
    public $controller = null;

    public $httpContext = null;

    public $isChildAction = false;

    public $requestContext = null;

    public $routeData = array();
    
    public function __construct($requestContext) {
    	echo $requestContext;
        $this->$requestContext = $requestContext;
    }
}

?>