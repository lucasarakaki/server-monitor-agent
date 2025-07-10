<?php

declare(strict_types=1);

namespace Tests\Unit\Collectors;

use App\Collectors\DiskCollector;
use App\Exceptions\CollectorException;
use PHPUnit\Framework\TestCase;

class DiskCollectorTest extends TestCase
{
    public function testCollectReturnsValidDiskUsage(): void
    {
        $collector = $this->getMockBuilder(DiskCollector::class)
            ->onlyMethods(['executeShellCommand'])
            ->getMock();

        $collector->method('executeShellCommand')->willReturn('50');

        $diskUsage = $collector->collector();

        $this->assertIsFloat($diskUsage);
        $this->assertEquals(50.0, $diskUsage);
    }

    public function testCollectThrowsExceptionOnCommandFailure(): void
    {
        $this->expectException(CollectorException::class);
        $this->expectExceptionMessage('Failed to execute shell command.');

        $collector = $this->getMockBuilder(DiskCollector::class)
            ->onlyMethods(['executeShellCommand'])
            ->getMock();

        $collector->method('executeShellCommand')->willReturn(null);

        $collector->collector();
    }

    public function testCollectThrowsExceptionOnInvalidValue(): void
    {
        $this->expectException(CollectorException::class);
        $this->expectExceptionMessage('Invalid disk value: 110');

        $collector = $this->getMockBuilder(DiskCollector::class)
            ->onlyMethods(['executeShellCommand'])
            ->getMock();

        $collector->method('executeShellCommand')->willReturn('110');

        $collector->collector();
    }
}
