<?php

declare(strict_types=1);

namespace Tests\Unit\Collectors;

use App\Collectors\UptimeCollector;
use App\Exceptions\CollectorException;
use PHPUnit\Framework\TestCase;

class UptimeCollectorTest extends TestCase
{
    public function testCollectReturnsValidUptimeUsage(): void
    {
        $collector = $this->getMockBuilder(UptimeCollector::class)
            ->onlyMethods(['executeShellCommand'])
            ->getMock();

        $collector->method('executeShellCommand')->willReturn('3600');

        $uptimeUsage = $collector->collector();

        $this->assertIsInt($uptimeUsage);
        $this->assertEquals(3600, $uptimeUsage);
    }

    public function testCollectThrowsExceptionOnCommandFailure(): void
    {
        $this->expectException(CollectorException::class);
        $this->expectExceptionMessage('Failed to execute shell command.');

        $collector = $this->getMockBuilder(UptimeCollector::class)
            ->onlyMethods(['executeShellCommand'])
            ->getMock();

        $collector->method('executeShellCommand')->willReturn(null);

        $collector->collector();
    }

    public function testCollectThrowsExceptionOnInvalidValue(): void
    {
        $this->expectException(CollectorException::class);
        $this->expectExceptionMessage('Invalid uptime value: -1');

        $collector = $this->getMockBuilder(UptimeCollector::class)
            ->onlyMethods(['executeShellCommand'])
            ->getMock();

        $collector->method('executeShellCommand')->willReturn('-1');

        $collector->collector();
    }
}
