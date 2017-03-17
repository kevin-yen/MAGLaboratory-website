<?php

require __DIR__ . '/../config/config.php';
require __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . '/helpers/hal_helpers_old.php';

$app = new \Slim\App();

$haldor_controller = new Controllers\Hal\Haldor($app);
//$halley_controller = new Controllers\Hal\Halley($app);

$app->run();



