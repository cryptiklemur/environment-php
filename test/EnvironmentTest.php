<?php

/**
 * Copyright 2013 Aaron Scherer
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
 * @copyright   Aaron Scherer 2013
 * @license     Apache License, Version 2.0
 */

namespace Aequasi\Environment\Test;

use Aequasi\Environment\Environment;

/**
 * @author Luis Cordova <cordoval@gmail.com>
 */
class EnvironmentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Aequasi\Environment\Environment */
    protected $environment;

    public function setUp()
    {
        $this->environment = new Environment();
    }

    /**
     * @test
     */
    public function the_default_type_is_dev()
    {
        $this->assertEquals(Environment::$DEFAULT_TYPE, $this->environment->getType());
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function the_test_type_is_a_debug_type()
    {
        $_SERVER['PHP_ENVIRONMENT'] = 'test';
        $this->environment = new Environment();

        $this->assertEquals('test', $this->environment->getType());
        $this->assertTrue($this->environment->isDebug());
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function the_type_can_be_defined_via_php_configuration()
    {
        if (!('test' === get_cfg_var('php.environment'))) {
            $this->markTestSkipped('only works');
        }

        $this->environment = new Environment();
        $this->assertEquals('test', $this->environment->getType());
    }

    /**
     * @test
     * @runInSeparateProcess
     *
     * @expectedException \Exception
     */
    public function it_throws_an_exception_when_the_type_is_invalid()
    {
        $_SERVER['PHP_ENVIRONMENT'] = 'invalid';
        $this->environment = new Environment();
    }

    /**
     * @test
     */
    public function it_allows_variable_names_for_ini_and_environment_to_be_defined()
    {
        $this->environment = new Environment('APP_ENV', 'php.app_env');

        $this->assertEquals(Environment::$DEFAULT_TYPE, $this->environment->getType());
        $this->assertTrue($this->environment->isDebug());
    }
}
