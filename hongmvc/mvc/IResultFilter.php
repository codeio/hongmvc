<?php

namespace hongmvc\mvc;

interface IResultFilter
{
    public function resultExecuting($filterContext);

    public function resultExecuted($filterContext);
}

?>