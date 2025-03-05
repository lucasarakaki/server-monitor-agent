<?php

// Loading autoloading composer
require __DIR__.'/vendor/autoload.php';

// Loading config
$config = require __DIR__.'/config/agent.php';

// Loading dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
