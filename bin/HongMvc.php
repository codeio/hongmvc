<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

if (!defined('MVC_BASE_PATH')) {
    define('MVC_BASE_PATH', MVC_PATH . 'base' . DS);
}

if (!defined('MVC_AREA_PATH')) {
    define('MVC_AREA_PATH', MVC_PATH . 'area' . DS);
}

if (!defined('MVC_FILTER_PATH')) {
    define('MVC_FILTER_PATH', MVC_PATH . 'filter' . DS);
}

if (!defined('MVC_RESULT_PATH')) {
    define('MVC_RESULT_PATH', MVC_PATH . 'result' . DS);
}

if (!defined('MVC_RESULTEXT_PATH')) {
    define('MVC_RESULTEXT_PATH', MVC_RESULT_PATH . 'extension' . DS);
}

if (!defined('MVC_ROUTE_PATH')) {
    define('MVC_ROUTE_PATH', MVC_PATH . 'route' . DS);
}

if (!defined('MVC_SYSTEM_PATH')) {
    define('MVC_SYSTEM_PATH', MVC_PATH . 'system' . DS);
}

if (!defined('MVC_VIEW_PATH')) {
    define('MVC_VIEW_PATH', MVC_PATH . 'view' . DS);
}

include_once MVC_BASE_PATH . 'ActionResult.php';
include_once MVC_BASE_PATH . 'ControllerContext.php';
include_once MVC_BASE_PATH . 'FilterAttribute.php';
include_once MVC_BASE_PATH . 'IActionFilter.php';
include_once MVC_BASE_PATH . 'IAuthorizationFilter.php';
include_once MVC_BASE_PATH . 'IExceptionFilter.php';
include_once MVC_BASE_PATH . 'IResultFilter.php';

include_once MVC_FILTER_PATH . 'ActionExecutedContext.php';
include_once MVC_FILTER_PATH . 'ActionExecutingContext.php';
include_once MVC_FILTER_PATH . 'ActionFilterAttribute.php';
include_once MVC_FILTER_PATH . 'ResultExecutedContext.php';
include_once MVC_FILTER_PATH . 'ResultExecutingContext.php';

include_once MVC_RESULT_PATH . 'ContentResult.php';
include_once MVC_RESULT_PATH . 'EmptyResult.php';
include_once MVC_RESULT_PATH . 'FileResult.php';
include_once MVC_RESULT_PATH . 'HttpStatusCodeResult.php';
include_once MVC_RESULT_PATH . 'JavaScriptResult.php';
include_once MVC_RESULT_PATH . 'JsonResult.php';
include_once MVC_RESULT_PATH . 'RedirectResult.php';
include_once MVC_RESULT_PATH . 'RedirectToRouteResult.php';
include_once MVC_RESULT_PATH . 'ViewResultBase.php';

include_once MVC_RESULTEXT_PATH . 'FileContentResult.php';
include_once MVC_RESULTEXT_PATH . 'FilePathResult.php';
include_once MVC_RESULTEXT_PATH . 'HttpNotFoundResult.php';
include_once MVC_RESULTEXT_PATH . 'HttpUnauthorizedResult.php';
include_once MVC_RESULTEXT_PATH . 'PartialViewResult.php';
include_once MVC_RESULTEXT_PATH . 'ViewResult.php';

include_once MVC_ROUTE_PATH . 'RouteCollection.php';
include_once MVC_ROUTE_PATH . 'RouteTable.php';

include_once MVC_SYSTEM_PATH . 'HtmlHelper.php';
include_once MVC_SYSTEM_PATH . 'Controller.php';

include_once MVC_VIEW_PATH . 'Smarty.class.php';


/**
 * MVC引擎入口类
 */
class Engine {

    private $_route = array();

    private $_viewEngine = null;

    public function __construct() {
        $this->_route = array(
            'module' => '',
            'controller' => 'home',
            'action' => 'index'
        );

        $cachePath = DATA_PATH . 'view' . DS;

        $this->_viewEngine = new Smarty;
        $this->_viewEngine->config_dir = $cachePath . 'config';
        $this->_viewEngine->template_dir = 'view';
        $this->_viewEngine->compile_check = true;
        $this->_viewEngine->compile_dir = $cachePath . 'compile';
        $this->_viewEngine->caching = false;
        $this->_viewEngine->cache_dir = $cachePath . 'cache';
        $this->_viewEngine->cache_lifetime = 120;
        $this->_viewEngine->debugging = false;
    }

    public function run() {
        if(isset($_GET['m'])) {
            $this->_route['module'] = strtolower(trim($_GET['m']));
        }

        if(isset($_GET['c'])) {
            $this->_route['controller'] = strtolower(trim($_GET['c']));
        }

        if(isset($_GET['a'])) {
            $this->_route['action'] = strtolower(trim($_GET['a']));
        }

        $htmlHelper = new HtmlHelper($this->_route, $this->_viewEngine);
        $this->_viewEngine->registerObject('html', $htmlHelper);
    }
}
?>

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