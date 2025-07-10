<?php

declare(strict_types = 1);

namespace App\Collectors;

use App\Exceptions\CollectorException;
use Exception;

class MemoryCollector
{
    /**
     * collecting memory metrics.
     */
    public function collector(): float
    {
        try {
            $output = $this->executeShellCommand("free | grep Mem | awk '{print $3/$2 * 100.0}'");

            if ($output === null) {
                throw new CollectorException('Failed to execute shell command.');
            }

            $memoryUsage = (float) trim($output);

            if ($memoryUsage < 0 || $memoryUsage > 100) {
                throw new CollectorException('Invalid memory value: '.$memoryUsage);
            }

            return $memoryUsage;
        } catch (Exception $e) {
            throw new CollectorException('Error collecting memory metrics'.$e->getMessage());
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
