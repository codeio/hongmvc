<?php

namespace hongmvc\di;

class ContainerBuilder
{
	private $_services = [];

    public function RegisterType(string $serviceType)
    {
    	if (isset($this->_services[$serviceType])) {
            return $this->_services[$serviceType];
        }

    	$reflection  = new ReflectionClass($serviceType);
		$instance = $reflection->newInstance();
		$this->_services[$serviceType] = $instance;

		return $instance;
    }

    public function build() {
        
    }
}

?>