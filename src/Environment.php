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

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class Environment
{
    /**
     * Allowed Types
     *
     * @var string[] $ALLOWED_TYPES
     */
    public static $ALLOWED_TYPES = ['dev', 'test', 'staging', 'prod'];

    /**
     * Default type for this class
     *
     * @var string $DEFAULT_TYPE
     */
    public static $DEFAULT_TYPE = 'prod';

    /**
     * Environment Types that should be in debug
     *
     * @var string[] $DEBUG_TYPES
     */
    public static $DEBUG_TYPES = ['dev', 'test'];

    /**
     * @var string
     */
    protected $type;

    /**
     * @var Boolean
     */
    protected $debug = false;

    /**
     * @var string[]
     */
    protected $envNames = ['PHP_ENVIRONMENT', 'APP_ENV'];

    /**
     * @var string
     */
    protected $iniName;

    /**
     * Sets the $type and $debug values.
     *
     * @throws \Exception
     *
     * @param string|array $envNames
     * @param string       $iniName
     */
    public function __construct($envNames = null, $iniName = 'php.environment')
    {
        if (!empty($envNames)) {
            $this->setEnvnames($envNames);
        }

        $this->iniName = $iniName;

        $this->type = $this->findType();
        $this->checkTypeAllowed();

        $this->debug = $this->findDebug();
    }

    /**
     * Checks $_SERVER[$this->environmentName], then
     * checks for the php.ini's php.environment.
     * Finally returns static::$DEFAULT_TYPE
     *
     * @return string
     */
    protected function findType()
    {
        foreach ($this->envNames as $envName) {
            if (isset($_SERVER[$envName])) {
                return $_SERVER[$envName];
            }
        }

        $cfgEnv = get_cfg_var($this->iniName);
        if ($cfgEnv !== false) {
            return $cfgEnv;
        }

        return static::$DEFAULT_TYPE;
    }

    /**
     * Makes sure the current type is allowed
     *
     * @throws \Exception
     */
    protected function checkTypeAllowed()
    {
        if (!in_array($this->type, static::$ALLOWED_TYPES)) {
            throw new \Exception(
                sprintf(
                    "`%s` is not a valid environment type. Expected one of: %s",
                    $this->type,
                    implode(', ', static::$ALLOWED_TYPES)
                )
            );
        }
    }

    /**
     * Checks if the environment should be in debug mode
     *
     * @return Boolean
     */
    protected function findDebug()
    {
        return in_array($this->type, static::$DEBUG_TYPES);
    }

    /**
     * @param array|string $names
     */
    public function setEnvNames($names)
    {
        if (is_string($names)) {
            $names = [$names];
        }

        array_merge($this->envNames, $names);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return Boolean
     */
    public function isDebug()
    {
        return $this->debug;
    }
}
