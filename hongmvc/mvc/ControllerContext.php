<?php

namespace hongmvc\mvc;

use hongmvc\web\RequestContext;

class ControllerContext
{
    public $controller = null;

    public $httpContext = null;

    public $isChildAction = false;

    public $requestContext = null;

    public $routeData = array();
    
    public function __construct(RequestContext $requestContext) {
        $this->requestContext = $requestContext;
    }
}

?>