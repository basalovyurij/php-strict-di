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
 * @author basalovyurij
 */
class ActivationException extends \Exception {
	
    const DEFAULT_CODE = 1;

    public function __construct($message, \Exception $previous = null) {
        // TODO Auto-generated method stub
        parent::__construct($message, self::DEFAULT_CODE, $previous);
    }
}
