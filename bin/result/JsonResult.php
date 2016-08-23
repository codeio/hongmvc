<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

class JsonResult extends ActionResult
{

    public $data = array();
    
    public function __construct($data) {
        $this->data = $data;
    }

    public function execute($controllerContext) {
        header('Content-Type: application/json; charset=utf-8');
        if(is_array($this->data)) {
            $this->arrayRecursive($this->data);
            $json = json_encode($this->data);
            echo urldecode($json);
        }
    }
    
    private function arrayRecursive(&$array)
    {
        static $count = 0;
        $temp = $array;
        if (++$count > 1000) {
            debug::systemError('possible deep recursion attack');
        }
        foreach ($temp as $key => $value) {
            if (is_array($value)) {
                $this->arrayRecursive($array[$key]);
            } else {
                $newKey = urlencode($key);
                $array[$key] = urlencode($value);
                
                if($newKey != $key) {
                    $array[$newKey] = urlencode($value);
                    unset($array[$key]);
                }
            }
        }
        $count--;
    }
}

?>