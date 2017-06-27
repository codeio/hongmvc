<?php

namespace hongmvc\mvc;

interface IExceptionFilter
{
    public function exception($filterContext);
}

?>