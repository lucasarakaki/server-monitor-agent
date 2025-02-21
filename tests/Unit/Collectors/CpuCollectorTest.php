<?php
namespace Tests\Unit\Collectors;

use App\Collectors\CpuCollector;
use PHPUnit\Framework\TestCase;

/**
 * Class for testing CpuCollector
 */
class CpuCollectorTest extends TestCase
{
    /**
     * This test checks if the collect() method returns a value between 0 and 100,
     * which is the expected range for CPU usage.
     */
    public function testCollectReturnsValidCpuUsage()
    {
        $cpuUsage = new CpuCollector();
        $cpuUsage = $cpuUsage->collector();

        $this->assertIsFloat($cpuUsage);
        $this->assertGreaterThanOrEqual(0, $cpuUsage);
        $this->assertLessThanOrEqual(100, $cpuUsage);
    }
}
