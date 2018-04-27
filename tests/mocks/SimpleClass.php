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
namespace StrictDI\TestMocks;

/**
 * @author basalovyurij
 */
class SimpleClass  {
	
	private $val;
	
	public function __construct() {
        $this->val = rand(1, 1000000);
    }
	
	public function getVal() {
		return $this->val;
	}
}
