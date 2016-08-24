<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

class ActionExecutedContext extends ControllerContext
{
    public $result = null;
    
    public $cancel = false;
    
    public function __construct($result) {
        $this->result = $result;
    }
}

?>