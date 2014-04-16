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

/**
 * @author Luis Cordova <cordoval@gmail.com>
 */
class EnvironmentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Allowed Types
     *
     * @var string[] $ALLOWED_TYPES
     */
    public static $ALLOWED_TYPES = ['dev', 'test', 'staging', 'prod'];

    public function the_default_type_is_dev()
    {

    }

    public function the_test_type_is_a_debug_type()
    {

    }

    public function the_type_can_be_defined_via_an_environmental_variable()
    {

    }

    public function the_type_can_be_defined_via_php_configuration()
    {

    }

    public function it_throws_an_exception_when_the_type_is_invalid()
    {

    }
}