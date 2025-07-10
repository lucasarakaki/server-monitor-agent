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
            $output = $this->executeShellCommand("top -bn1 | grep 'Cpu(s)' | sed 's/.*, *\([0-9.]*\)%* id.*/\1/'");

            if ($output === null) {
                throw new CollectorException('Failed to execute shell command.');
            }

            $cpuUsage = 100 - (float) trim($output);

            if ($cpuUsage < 0 || $cpuUsage > 100) {
                throw new CollectorException('Invalid CPU Value: '.$cpuUsage);
            }

            return $cpuUsage;
        } catch (Exception $e) {
            throw new CollectorException('Error collecting CPU metrics: '.$e->getMessage());
        }
    }

    /**
     * Executes a shell command.
     */
    protected function executeShellCommand(string $command): ?string
    {
        return shell_exec($command);
    }
}
