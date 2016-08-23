<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

class HttpNotFoundResult extends ActionResult
{
    
    public $errorMsg = 'Not Found';
    
    public function __construct($errorMsg) {
        $this->errorMsg = $errorMsg;
    }

    public function execute($controllerContext) {
    
        header('HTTP/1.1 404 Not Found');
        
        $template = $controllerContext->template;
        
        if (isset($template)) {
            $path = ROOT_PATH . 'view' . DIRECTORY_SEPARATOR . 'shared' . DIRECTORY_SEPARATOR . '404.html';
            
            if(is_file($path)) {
                $template->assign('error', $this->errorMsg);
                $template->display($path);
            } else {
                echo $this->errorMsg;
            }
        }
    }
}

?>