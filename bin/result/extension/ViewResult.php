<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

class ViewResult extends ActionResult
{
    private $viewName = '';
    
    public function __construct($viewName) {
        $this->viewName = $viewName;
    }

    public function execute($controllerContext) {
        $template = $controllerContext->template;
        
        if (isset($template)) {
            $controllerName = $controllerContext->route['controller'];
            $actionName = $controllerContext->route['action'];
            
            if(empty($this->viewName)) {
                $path = $controllerName . DIRECTORY_SEPARATOR . $actionName . '.html';
            } else {
                $path = $controllerName . DIRECTORY_SEPARATOR . $this->viewName . '.html';
            }
            $template->assign('route', $controllerContext->route);
            $template->display($path);
        }
    }
}

?>