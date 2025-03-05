<?php

namespace App;

use Exception;
use App\Services\ApiService;
use App\Services\LoggerService;
use App\Collectors\CpuCollector;
use App\Collectors\DiskCollector;
use App\Collectors\MemoryCollector;
use App\Collectors\UptimeCollector;

class Agent
{
    /**
     * Class constructor
     *
     * @param private readonly
     * @param private readonly
     */
    public function __construct(private readonly ApiService $apiService, private readonly LoggerService $loggerService)
    {
    }

    /**
     * Class run
     * Collects metrics and sends them to the API, generating logs
     */
    public function run(string $uri): void
    {
        $cpuUsage    = new CpuCollector();
        $diskUsage   = new DiskCollector();
        $memoryUsage = new MemoryCollector();
        $uptime      = new UptimeCollector();

        $metrics = [
            'cpu_usage'    => $cpuUsage->collector(),
            'disk_usage'   => $diskUsage->collector(),
            'memory_usage' => $memoryUsage->collector(),
            'uptime'       => $uptime->collector(),
        ];

        try {
            $this->apiService->sendMetricsApi($metrics, $uri);
            $this->loggerService->log('Metrics sent successfully '.json_encode($metrics));
        } catch (Exception $e) {
            $this->loggerService->log('Error '.$e->getMessage());
        }
    }
}
