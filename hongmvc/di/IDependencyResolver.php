<?php

namespace hongmvc\di;

interface IDependencyResolver
{
    public function getService($serviceType);
}

?>