<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

class RedirectResult extends ActionResult
{

    public $url = '';
    
    public $statusCode = 302;
    
    public function __construct($url, $statusCode) {
        $this->url = $url;
        $this->statusCode = $statusCode;
    }

    public function execute($controllerContext) {
        if(!empty($this->url)) {
            if($this->statusCode == 302) {
                header('HTTP/1.1 302 Found');
            }
            
            if($this->statusCode == 301) {
                header('HTTP/1.1 301 Moved Permanently');
            }
            
            header('Location: ' . $this->url);
        }
    }
}

?>