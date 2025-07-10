<?php

declare(strict_types = 1);

namespace App\Collectors;

use App\Exceptions\CollectorException;
use Exception;

class DiskCollector
{
    /**
     * collecting disk metrics.
     */
    public function collector(): float
    {
        try {
            $output = $this->executeShellCommand("df --output=pcent / | tail -n 1 | tr -d ' %'");

            if ($output === null) {
                throw new CollectorException('Failed to execute shell command.');
            }

            if (!is_numeric($output)) {
                throw new CollectorException('Invalid disk value received from command.');
            }

            $diskUsage = (float) trim($output);

            if ($diskUsage < 0 || $diskUsage > 100) {
                throw new CollectorException('Invalid disk value: '.$diskUsage);
            }

            return $diskUsage;
        } catch (Exception $e) {
            throw new CollectorException('Error collecting disk metrics: '.$e->getMessage());
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
