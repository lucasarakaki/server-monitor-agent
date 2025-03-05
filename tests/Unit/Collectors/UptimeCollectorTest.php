<?php

declare(strict_types = 1);

namespace Tests\Unit\Collectors;

use App\Collectors\UptimeCollector;
use PHPUnit\Framework\TestCase;

/**
 * Class for testing UptimeCollector.
 */
class UptimeCollectorTest extends TestCase
{
    public function testCollectReturnsValidUptimeUsage(): void
    {
        $uptimeUsage = new UptimeCollector();
        $uptimeUsage = $uptimeUsage->collector();

        $this->assertIsInt($uptimeUsage);
        $this->assertGreaterThanOrEqual(0, $uptimeUsage);
    }
}
