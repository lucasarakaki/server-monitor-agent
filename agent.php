<?php

require __DIR__.'/bootstrap.php';

use App\Agent;
use App\Services\ApiService;
use App\Services\LoggerService;

$api   = new ApiService($config['api']['url']);
$log   = new LoggerService(__DIR__.'/storage/logs/agent.log');
$agent = new Agent($api, $log);
$agent->run('metrics');
