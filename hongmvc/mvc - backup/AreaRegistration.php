<?php

namespace hong\mvc;

abstract class ActionResult
{
    public abstract function execute($controllerContext);
}

?>