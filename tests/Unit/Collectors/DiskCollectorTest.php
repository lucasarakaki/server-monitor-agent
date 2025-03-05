<?php
namespace Tests\Unit\Collectors;

use App\Collectors\DiskCollector;
use PHPUnit\Framework\TestCase;

/**
 * Class for testing DiskCollector
 */
class DiskCollectorTest extends TestCase
{
    /**
     * This test checks if the collect() method returns a value between 0 and 100,
     * which is the expected range for Disk usage.
     */
    public function testCollectReturnsValidDiskUsage()
    {
        $diskUsage = new DiskCollector();
        $diskUsage = $diskUsage->collector();

        $this->assertIsFloat($diskUsage);
        $this->assertGreaterThanOrEqual(0, $diskUsage);
        $this->assertLessThanOrEqual(100, $diskUsage);
    }
}
