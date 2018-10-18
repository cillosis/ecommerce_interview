<?php

// Autoload namespaced classes via Composer
$autoloaderPath = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
require_once($autoloaderPath);

// Create new application instance
$app = new App\App();

// Load utility functions
$functionsPath = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'library'.DIRECTORY_SEPARATOR.'utility'.DIRECTORY_SEPARATOR.'functions.php';
require_once($functionsPath);

// Handle request
$app->run();
