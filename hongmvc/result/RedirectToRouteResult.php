<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

class RedirectToRouteResult extends ActionResult
{

    public $actionName = '';
    
    public $data = array();

    public function __construct($actionName, $data) {
        $this->actionName = $actionName;
        $this->data = $data;
    }

    public function execute($controllerContext) {
        if(!empty($this->actionName)) {
            
            $params['a'] = $this->actionName;
            
            $route = $controllerContext->route;
            
            $params['c'] = isset($this->data['c'])
                            ? $this->data['c']
                            : $route['controller'];
            
            $params['m'] = isset($this->data['m'])
                            ? $this->data['m']
                            : $route['module'];
            
            foreach($this->data as $key => $value) {
                if(!in_array($key, array('m', 'c', 'a'))) {
                    $params[$key] = $value;
                }
            }

            $htmlHelper = new HtmlHelper($route, $controllerContext->template);
            $url = $htmlHelper->url($params);

            header('HTTP/1.1 302 Found');
            header('Location: ' . $url);
        }
    }
}

?>