<?php
namespace Tests\Unit\Collectors;

use App\Collectors\MemoryCollector;
use PHPUnit\Framework\TestCase;

/**
 * Class for testing MemoryCollector
 */
class MemoryCollectorTest extends TestCase
{
    /**
     * This test checks if the collect() method returns a value between 0 and 100,
     * which is the expected range for Memory usage.
     */
    public function testCollectReturnsValidMemoryUsage(): void
    {
        $memoryUsage = new MemoryCollector();
        $memoryUsage = $memoryUsage->collector();

        $this->assertIsFloat($memoryUsage);
        $this->assertGreaterThanOrEqual(0, $memoryUsage);
        $this->assertLessThanOrEqual(100, $memoryUsage);
    }

}
