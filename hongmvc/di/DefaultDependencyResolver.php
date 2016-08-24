<?php

namespace hongmvc\di;

class DefaultDependencyResolver implements IDependencyResolver
{
    public function getService($serviceType)
    {
        return 'this is single service';
    }

    public function getServices($serviceType)
    {
        return 'this is muitl service';
    }
}

?>