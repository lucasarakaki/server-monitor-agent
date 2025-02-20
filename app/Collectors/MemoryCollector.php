<?php
namespace App\Collectors;

use App\Exceptions\CollectorException;
use Exception;

class MemoryCollector
{
    /**
     * collecting memory metrics
     *
     * @return float
     */
    public function collector(): float
    {
        try {
            $output = shell_exec("free | grep Mem | awk '{print $3/$2 * 100.0}'");

            $memoryUsage = (float) trim($output);

            if ($memoryUsage < 0 || $memoryUsage > 100) {
                throw new CollectorException('Invalid memory value' . $memoryUsage);
            }

            return $memoryUsage;
        } catch (Exception $e) {
            throw new CollectorException('Error collecting memory metrics' . $e->getMessage());
        }
    }
}
