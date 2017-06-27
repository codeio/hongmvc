<?php

if(!defined('IN_HONG')) {
    exit('Access Denied');
}

class Pager {

    var $recordCount;
    var $pageSize = 10;
    var $linkCount = 7;
    var $pageCurrent = 1;
    var $startIndex = 1;
    var $endIndex = 1;
    var $pageCount;
    
    function Pager($recordCount) {
        $this->recordCount = $recordCount;
        $this->pageCount = ceil($this->recordCount / $this->pageSize);
    }
    
    function setPageSize($count) {
        $this->pageSize = $count;
        $this->pageCount = ceil($this->recordCount / $this->pageSize);
    }
    
    function setPageCurrent($current)
    {
        $current = intval($current);
        
        if ($this->pageCount > 0)
        {
            if ($current <= 0)
            {
                $this->pageCurrent = 1;
            }
            else if ($current > $this->pageCount)
            {
                $this->pageCurrent = $this->pageCount;
            }
            else
            {
                $this->pageCurrent = $current;
            }

            if ($this->pageCount <= $this->linkCount)
            {
                $this->startIndex = 1;
                $this->endIndex = $this->pageCount;
            }
            else
            {
                if ($this->pageCurrent - floor($this->linkCount / 2) <= 1)
                {
                    $this->startIndex = 1;
                    $this->endIndex = $this->linkCount;
                }
                else
                {
                    if ($this->pageCurrent + floor($this->linkCount / 2) >= $this->pageCount)
                    {
                        $this->startIndex = $this->pageCount - $this->linkCount + 1;
                        $this->endIndex = $this->pageCount;
                    }
                    else
                    {
                        $this->startIndex = $this->pageCurrent - floor($this->linkCount / 2);
                        $this->endIndex = $this->pageCurrent + floor($this->linkCount / 2);
                    }
                }
            }
        }
    }
    
    function createUrl($current) {
        $arr = array();
        if(empty($_GET)) {
            array_push($arr, "p=$current");
        } else {
            foreach($_GET as $key => $value) {
                if($key == 'p') {
                    array_push($arr, "$key=$current");
                } else {
                    array_push($arr, "$key=$value");
                }
            }
            
            if(!isset($_GET['p'])) {
                array_push($arr, "p=$current");
            }
        }

        return $arr ? '?' . implode('&', $arr) : '';
    }
}