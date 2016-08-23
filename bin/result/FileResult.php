<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

class FileResult extends ActionResult
{

    public $path = '';
    public $name = '';
    public $type = '';
    
    public function __construct($name, $path, $type) {
        $this->name = $name;
        $this->path = $path;
        $this->type = $type;
    }

    public function execute($controllerContext) {
        if(!empty($this->name) && !empty($this->path)) {
            $this->download($this->name, $this->path, $this->type);
        }
    }
    
    function download($name, $path, $type){
        if(is_file($path)) {
            $file = fopen($path, "r");
            
            if(empty($type)) {
                header("Content-type: application/octet-stream");
                header("Accept-Ranges: bytes");
                header("Accept-Length: " . filesize($path));
                header("Content-Disposition: attachment; filename=" . $name);
            } else {
                header("Content-type: " . $type);
            }
            
            echo fread($file, filesize($path));
            fclose($file);
        }
    }
}

?>