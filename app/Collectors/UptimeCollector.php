<?php
namespace App\Collectors;

use App\Exceptions\CollectorException;
use Exception;

class UptimeCollector
{
    /**
     * collecting uptime metrics
     *
     * @return int
     */
    public function collector(): int
    {
        try {
            $output = shell_exec("cat /proc/uptime | awk '{print $1}'");

            $uptimeUsage = (int) trim($output);

            if ($uptimeUsage < 0) {
                throw new CollectorException('Invalid uptime value: ' . $uptimeUsage);
            }

            return $uptimeUsage;
        } catch (Exception $e) {
            throw new CollectorException('Error collecting uptime metrics' . $e->getMessage());

        }
    }
}
