<?php
/*
 * This file is part of https://github.com/basalovyurij/php-strict-di.
 * 
 * (C) Copyright 2018    Basalov Yurij. All rights reserved.
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
 * A minimalistic dependency container.
 *
 * @author basalovyurij
 */
class Kernel {
    
    /**
     * The collection of dependencies contained.
     * @var Dependency[]
     */
    private $dependencies;
    
    /**
     * Is auto binding enabled.
     * @var boolean
     */
    private $isAutoBinding;
    
    /**
     * Max recursion depth for auto binding.
     * @var integer
     */
    private $maxAutoBindingDepth;

    public function __construct($modules = array()) {
        $this->dependencies = array();
        $this->isAutoBinding = true;
        $this->maxAutoBindingDepth = 10;
        
        if(!is_array($modules)) {
            $modules = array($modules);
        }

        foreach ($modules as $module) {
            $module->setKernel($this);
            $module->load();
        }
    }

    /**
     * Adds an object dependency
     *
     * @param string   $className        The className of the dependency
     * @param callable $depth            The recursion depth for the dependency object
     *
     * @return Dependency                 The Dependency wrapper for next setup
     * @throws ActivationException         If the max autobinding depth exceeded
     */
    public function bind($className) {        
        $dependency = new Dependency($this, $className);
        $this->dependencies[$className] = $dependency;
        
        return $dependency;
    }

    public function hasBinging($className) {        
        return array_key_exists($className, $this->dependencies);
    }

    public function isAutoBinding() {
        return $this->isAutoBinding;
    }

    public function getMaxAutoBindingDepth() {
        return $this->maxAutoBindingDepth;
    }
    
    /**
     * Gets the dependency identified by the given className.
     *
     * @param string $className            The className of the dependency
     *
     * @return object                     The object identified by the given id
     * @throws ActivationException        If there's not dependency with the given id
     */
    public function get($className, array $params = array()) {
        if (!isset($this->dependencies[$className])) {
            throw new ActivationException("Dependency identified by '$className' does not exist");
        }
        return $this->dependencies[$className]->get($params);
    }
}