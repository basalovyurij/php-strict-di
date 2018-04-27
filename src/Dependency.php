<?php
/*
 * This file is part of https://github.com/basalovyurij/php-strict-di.
 * 
 * (C) Copyright 2018	Basalov Yurij. All rights reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */
namespace StrictDI;

/**
 * Represents a dependency, with a loader that is the generator of the dependency object
 * and the object itself.
 * If the object is treated as a singleton the same instance
 * is always returned.
 *
 * @author basalovyurij
 */
class Dependency {

    private $kernel;
	
    private $className;

	private $paramNames;

	private $defaultParams;

    private $instance;
	
    private $singleton;
	
    public function __construct(Kernel $kernel, $className) {
        $this->kernel = $kernel;
        $this->className = $className;
        $this->paramNames = array();
        $this->defaultParams = array();
        $this->instance = null;
        $this->singleton = false;
    }
	
	/**
     * 
     */
    public function addParam($name, $type) {
        $this->paramNames[$name] = $type;
    }
	
    /**
     * 
     */
    public function inSingeltonScope() {
        $this->singleton = true;
		return $this;
    }
	
    /**
     * 
     */
    public function to($className) {
        $this->className = $className;
		return $this;
    }
	
    /**
     * 
     */
    public function withConstrucorArguments($params) {
        $this->defaultParams[] = $params;
		return $this;
    }

    /**
     * Returns the specific dependency instance.
     *
     * @return mixed
     */
    public function get($customParams) {
        if (!$this->singleton) {
            return $this->create($customParams);
        }
		
        if ($this->instance === null) {
            $this->instance = $this->create($customParams);
        }

        return $this->instance;
    }
	
	/**
     * 
     */
    private function create($customParams) {
		$args = array();
		foreach ($this->paramNames as $name => $type) {
			$args[] = $this->getParam($name, $type, $customParams);
		}
		
		return (new \ReflectionClass($this->className))->newInstanceArgs($args);
	}
	
	private function getParam($name, $type, $customParams) {
		if(array_key_exists($name, $customParams)) {
			return $customParams[$name];
		} 
		
		if(array_key_exists($name, $this->defaultParams)) {
			return $this->defaultParams[$name];
		}
			
		return $this->kernel->get($type);
	}
}
