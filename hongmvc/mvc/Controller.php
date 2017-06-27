<?php

namespace hongmvc\mvc;

class Controller extends ControllerBase implements IActionFilter, IExceptionFilter, IResultFilter, IController
{
	public $resolver = null;

	public $httpContext = null;

	public $routeData = null;

	public function init($requestContext)
    {
    	parent::init($requestContext);
    }

    public function actionExecuting($filterContext)
    {
    	echo 111;
    }

    public function actionExecuted($filterContext)
    {

    }

    public function exception($filterContext)
    {

    }

    public function execute($requestContext)
    {

    }

    public function resultExecuting($filterContext)
    {

    }

    public function resultExecuted($filterContext)
    {

    }

    protected function redirect()
    {

    }

    protected function view()
    {
    	
    }
}

?>