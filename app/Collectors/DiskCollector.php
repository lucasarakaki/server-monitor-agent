<?php
namespace App\Collectors;

use App\Exceptions\CollectorException;
use Exception;

class DiskCollector
{
    /**
     * collecting disk metrics
     */
    public function collector(): float
    {
        try {
            $output = shell_exec("df -h | awk '$6 == \"/\" {print $5}' | sed 's/%//'");

            $diskUsage = (float) trim($output);

            if ($diskUsage < 0 || $diskUsage > 100) {
                throw new CollectorException('Invalid disk value' . $diskUsage);
            }

            return $diskUsage;
        } catch (Exception $e) {
            throw new CollectorException('Error collecting disk metrics' . $e->getMessage());
        }
    }
}
