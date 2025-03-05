<?php

declare(strict_types = 1);

// Loading autoloading composer
require __DIR__.'/vendor/autoload.php';

// Loading dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Loading config
$config = require __DIR__.'/config/agent.php';
