<?php

namespace hongmvc\mvc;

abstract class ControllerBase implements IController
{
	public $controllerContext = null;

	public $viewData = array();

    public function init($requestContext)
    {
    	$this->controllerContext = new ControllerContext($requestContext);
    }

    public function execute($requestContext)
    {

    }
}

?>