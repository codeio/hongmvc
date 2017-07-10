<?php

namespace HongMvc\Web;

class HttpServerUtility
{
    public $controller = null;

    public $httpContext = null;

    public $isChildAction = false;

    public $requestContext = null;

    public $routeData = array();
    
    public function test() {
    	echo 111222;
    }
    
}

?>