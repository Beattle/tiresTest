<?php

use Psr\Container\ContainerInterface;
use Slim\App;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;

require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/bootstrap_console.php';

/** @var App $app */
$container = $app->getContainer();

$application = $container->get(Application::class);
$application->run();