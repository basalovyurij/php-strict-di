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

use PHPUnit\Framework\TestCase;

/**
 * @author basalovyurij
 */
class IntegrationTests extends TestCase {
	
    public function testParamaterlessDependency() {
        $kernel = new Kernel();
		$kernel->bind('StrictDI\TestMocks\SimpleClass')->toSelf();
		
		$this->assertInstanceOf('StrictDI\TestMocks\SimpleClass', $kernel->get('StrictDI\TestMocks\SimpleClass'));
		$this->assertGreaterThan(0, $kernel->get('StrictDI\TestMocks\SimpleClass')->getVal());
    }
	
	public function testNotSingelton() {
        $kernel = new Kernel();
		$kernel->bind('StrictDI\TestMocks\SimpleClass')->toSelf();
		
		$this->assertNotEquals($kernel->get('StrictDI\TestMocks\SimpleClass')->getVal(), $kernel->get('StrictDI\TestMocks\SimpleClass')->getVal());
    }
	
	public function testSingelton() {
        $kernel = new Kernel();
		$kernel->bind('StrictDI\TestMocks\SimpleClass')->toSelf()->inSingeltonScope();
		
		$this->assertEquals($kernel->get('StrictDI\TestMocks\SimpleClass')->getVal(), $kernel->get('StrictDI\TestMocks\SimpleClass')->getVal());
    }
	
	public function testRealDependency() {
        $kernel = new Kernel();
		$kernel->bind('StrictDI\TestMocks\CompositeClass')->toSelf();
		
		$this->assertInstanceOf('StrictDI\TestMocks\CompositeClass', $kernel->get('StrictDI\TestMocks\CompositeClass'));
		$this->assertGreaterThan(0, $kernel->get('StrictDI\TestMocks\CompositeClass')->getVal());
    }
}

