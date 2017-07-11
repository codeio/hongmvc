<?php

namespace hongmvc\di;
use ReflectionClass;

class DefaultDependencyResolver implements IDependencyResolver
{
	private $_services = [];

    public function getService($serviceType)
    {
    	if (isset($this->_services[$serviceType])) {
            return $this->_services[$serviceType];
        }

    	$reflection  = new ReflectionClass($serviceType);
		$instance = $reflection->newInstance();
		$this->_services[$serviceType] = $instance;

		return $instance;
    }

    public function getServices($serviceType)
    {
        return 'this is muitl service';
    }
}

?>