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
use Aequasi\Environment\SymfonyEnvironment;
use Symfony\Component\Console\Input\ArgvInput;

/**
 * @author Luis Cordova <cordoval@gmail.com>
 */
class SymfonyEnvironmentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Aequasi\Environment\Environment */
    protected $environment;

    /**
     * @test
     */
    public function it_falls_back_when_no_custom_input_passed()
    {
        $this->environment = new SymfonyEnvironment();

        $this->assertEquals(
            Environment::$DEFAULT_TYPE,
            $this->environment->getType()
        );
        $this->assertTrue($this->environment->isDebug());
    }

    /**
     * @test
     */
    public function it_gets_type_from_input_args()
    {
        $input = new ArgvInput(['command:name', '--env=test']);
        $this->environment = new SymfonyEnvironment($input);

        $this->assertEquals(
            'test',
            $this->environment->getType()
        );
        $this->assertTrue($this->environment->isDebug());
    }

    /**
     * @test
     */
    public function it_detects_is_debug_from_input_args()
    {
        $input = new ArgvInput(['command:name', '--no-debug']);
        $this->environment = new SymfonyEnvironment($input);

        $this->assertFalse($this->environment->isDebug());
    }
}
