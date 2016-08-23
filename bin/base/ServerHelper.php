<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

/**
 * 核心服务类
 */
class ServerHelper {
    
    private static $_objs = array();
    
    private static $_funcs = array();
    
    public static function loadSysClass($name, $path = '') {
        $name = ucwords(strtolower($name));
        
        if(empty($path)){
            $path = SYSTEM_PATH . 'class' . DS . $name . '.php';
        }
        
        $key = md5($path . $name);
        
        if (isset(self::$_objs[$key])) return self::$_objs[$key];
        
        if(is_file($path)) {
            require $path;
			self::$_objs[$key] = new $name;
            return self::$_objs[$key];
        } else {
            systemError('111', '222');
        }
    }
    
    public static function loadSysFunc($name, $path = '') {
        $name = ucwords(strtolower($name));
        
        if(empty($path)){
            $path = SYSTEM_PATH . 'function' . DS . $name . '.php';
        }
        
        $key = md5($path);
        
        if (isset(self::$_funcs[$key])) return true;
        
        if (file_exists(PC_PATH.$path)) {
			include PC_PATH.$path;
		} else {
			$funcs[$key] = false;
			return false;
		}
		$funcs[$key] = true;
		return true;
        
        if(is_file($path)) {
            require $path;
			self::$_objs[$key] = new $name;
            return self::$_objs[$key];
        } else {
            systemError('111', '222');
        }
    }
    
    public static function loadClass($name) {
        
    }
    
    public static function loadFunc($name) {
        
    }
    
    public static function loadConfig($name, $key) {
        
    }
    
    public static function loadModel($name, $key) {
        
    }
    
    public static function loadService($name, $key) {
        
    }

}

?>