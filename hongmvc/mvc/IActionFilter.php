<?php

namespace hongmvc\mvc;

interface IActionFilter
{
    public function actionExecuting($filterContext);

    public function actionExecuted($filterContext);
}

?>