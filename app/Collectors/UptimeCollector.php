<?php

declare(strict_types = 1);

namespace App\Collectors;

use App\Exceptions\CollectorException;
use Exception;

class UptimeCollector
{
    /**
     * collecting uptime metrics.
     */
    public function collector(): int
    {
        try {
            $output = $this->executeShellCommand("cat /proc/uptime | awk '{print $1}'");

            if ($output === null) {
                throw new CollectorException('Failed to execute shell command.');
            }

            $uptimeUsage = (int) trim($output);

            if ($uptimeUsage < 0) {
                throw new CollectorException('Invalid uptime value: '.$uptimeUsage);
            }

            return $uptimeUsage;
        } catch (Exception $e) {
            throw new CollectorException('Error collecting uptime metrics'.$e->getMessage());
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
