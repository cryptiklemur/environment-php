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

namespace Aequasi\Environment;

use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputInterface;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class SymfonyEnvironment extends Environment
{
    /**
     * Instance of Symfony's InputInterface
     * Likely: Symfony\Component\Console\Input\ArgvInput
     *
     * @var InputInterface $input
     */
    protected $input;

    /**
     * Builds the $input parameter as well
     *
     * {@inheritDoc}
     *
     * @param InputInterface $input
     * @param string|array   $envNames
     * @param string         $iniName
     */
    public function __construct(
        InputInterface $input = null,
        $envNames = null,
        $iniName = 'php.environment'
    ) {
        $this->input = $input !== null ? $input : new ArgvInput();

        parent::__construct($envNames, $iniName);
    }

    /**
     * Checks the arguments for --env or -e
     *
     * {@inheritDoc}
     */
    protected function findType()
    {
        $env = $this->input->getParameterOption(['--env', '-e']);
        return !empty($env) ? $env : parent::findType();
    }

    /**
     * Checks the arguments for --no-debug
     *
     * {@inheritDoc}
     */
    protected function findDebug()
    {
        return $this->input->hasParameterOption(['--no-debug']) ? false : parent::findDebug();
    }
}
 