<?php

declare(strict_types = 1);

namespace App\Collectors;

use App\Exceptions\CollectorException;
use Exception;

class CpuCollector
{
    /**
     * collecting CPU metrics.
     */
    public function collector(): float
    {
        try {
            $output = shell_exec("top -bn1 | grep 'Cpu(s)' | sed 's/.*, *\\([0-9.]*\\)%* id.*/\\1/'");

            $cpuUsage = 100 - (float) trim($output);

            if ($cpuUsage < 0 || $cpuUsage > 100) {
                throw new CollectorException('Invalid CPU Value: '.$cpuUsage);
            }

            return $cpuUsage;
        } catch (Exception $e) {
            throw new CollectorException('Error collecting CPU metrics: '.$e->getMessage());
        }
    }
}
