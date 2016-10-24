<?php

/**
 * 应用入口类
 */
class HongMvc {

    private static $_inited = false;
    
    /**
     * 初始化入口
     */
    public static function init() {
        if(self::$_inited === false) {
            self::_initEnv();
            self::_initInput();
            self::_initOutput();
        }
        self::$_inited = true;
    }

    /**
     * 初始化环境变量
     */
    private static function _initEnv() {
    
        error_reporting(E_ALL);

        if(PHP_VERSION < '5.3.0') {
            set_magic_quotes_runtime(0);
        }

        if(function_exists('date_default_timezone_set')) {
            date_default_timezone_set('PRC');
        }
        
        define('HONG_VERSION', '1.0');
        define('IN_HONG', true);
        define('DS', DIRECTORY_SEPARATOR);
        define('HONG_ROOT', self::_getRoot());
        define('BIN_PATH', HONG_ROOT . 'bin' . DS);
        define('MVC_PATH', BIN_PATH . 'mvc' . DS);
		define('SYSTEM_PATH', BIN_PATH . 'system' . DS);
        define('DATA_PATH', HONG_ROOT . 'data' . DS);
        define('HONG_URL', self::_getUrl());
        
        require SYSTEM_PATH . 'Core.php';
        require SYSTEM_PATH . 'Server.php';
        
        //$mvcEngine = Server::loadSysClass('engine');
        //$mvcEngine->run();
    }
    
    /**
     * 初始化输入参数
     */
    private static function _initInput() {
        if(!(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())) {
            $_GET = daddslashes($_GET);
            $_POST = daddslashes($_POST);
            $_COOKIE = daddslashes($_COOKIE);
            $_FILES = daddslashes($_FILES);
        }
    }
    
    /**
     * 初始化输出参数
     */
    private static function _initOutput() {
        session_start();
        header('Content-Type: text/html; charset=utf-8');
    }
    
    /**
     * 获得根网址
     */
    private static function _getUrl() {
        $protocol = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $sitepath = substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
        return $protocol . $_SERVER['HTTP_HOST'] . $sitepath . '/';
    }
    
    /**
     * 获得根目录
     */
    private static function _getRoot() {
        return substr(dirname(__FILE__), 0, -3);
    }
}
?>