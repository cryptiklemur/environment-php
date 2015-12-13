Environment - [![Build Status](https://www.codeship.io/projects/eb8d40e0-a738-0131-c660-26855b373a72/status)](https://www.codeship.io/projects/18972)
===========

This class is pretty simple. It adds environments to your PHP project.

## To Install

Install with composer:

```sh
composer require aequasi/environment
```

## To Use

To get set up super simply, all you have to do is drop the `Environment` class in your
front controller. For example:

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

$environment = new Aequasi\Environment\Environment;

// By default, the environment is set to 'dev'
echo $environment->getType();
// Above will echo 'dev';
var_dump($environment->isDebug());
// Above will dump true
```

You can set what the default environment is with `Environment::$DEFAULT_ENVIRONMENT` (`string`),
and you can set what environments are in debug mode with `Environment::$DEBUG_TYPES` (`string[]`).

The allowed environments can also be changed by overriding the `Environment::$DEFAULT_TYPE` (`string[]`) parameter.

### Setting Environments

Once you are ready to start using other environments (`test`, `staging`, and `prod`), there are a couple ways to do that.

#### 1. `php.ini`

In your `php.ini` file, setting `php.environment` will set the environment for all processes using the php for that php.ini

#### 2. `$_SERVER['PHP_ENVIRONMENT']`

You can either use Apache or Nginx to set a server variable, or you can modify your `$_SERVER` header to set the environment

* For Apache, use [`SetEnv`][0]
* And Nginx is a little different. Check [this][1] StackOverflow post for an example.

#### 3. CLI Arguments

If you are using the `SymfonyEnvironment` class, you can tie into the arguments (`--env` and `--no-debug`) by creating your environment
a little differently:

```php
#!/usr/bin/env php
<?php
set_time_limit(0);

require_once __DIR__.'/bootstrap.php.cache';
require_once __DIR__.'/AppKernel.php';

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Debug\Debug;
use Aequasi\Environment\SymfonyEnvironment;

$input = new ArgvInput( );
$env = new SymfonyEnvironment( $input );

if( $env->isDebug() ) {
  Debug::enable();
}

$kernel = new AppKernel( $env->getType(), $env->isDebug() );
$application = new Application($kernel);
$application->run( $input );
```


[0]: http://httpd.apache.org/docs/2.2/mod/mod_env.html#SetEnv
[1]: http://stackoverflow.com/a/19491780/248903
