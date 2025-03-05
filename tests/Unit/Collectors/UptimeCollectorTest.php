<?php
namespace Tests\Unit\Collectors;

use App\Collectors\UptimeCollector;
use PHPUnit\Framework\TestCase;

/**
 * Class for testing UptimeCollector
 */
class UptimeCollectorTest extends TestCase
{
    public function testCollectReturnsValidUptimeUsage()
    {
        $uptimeUsage = new UptimeCollector();
        $uptimeUsage = $uptimeUsage->collector();

        $this->assertIsInt($uptimeUsage);
        $this->assertGreaterThanOrEqual(0, $uptimeUsage);
    }
}
