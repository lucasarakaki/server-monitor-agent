<?php

declare(strict_types=1);

namespace Tests\Unit\Collectors;

use App\Collectors\CpuCollector;
use App\Exceptions\CollectorException;
use PHPUnit\Framework\TestCase;

class CpuCollectorTest extends TestCase
{
    public function testCollectReturnsValidCpuUsage(): void
    {
        $collector = $this->getMockBuilder(CpuCollector::class)
            ->onlyMethods(['executeShellCommand'])
            ->getMock();

        $collector->method('executeShellCommand')->willReturn('10');

        $cpuUsage = $collector->collector();

        $this->assertIsFloat($cpuUsage);
        $this->assertEquals(90.0, $cpuUsage);
    }

    public function testCollectThrowsExceptionOnCommandFailure(): void
    {
        $this->expectException(CollectorException::class);
        $this->expectExceptionMessage('Failed to execute shell command.');

        $collector = $this->getMockBuilder(CpuCollector::class)
            ->onlyMethods(['executeShellCommand'])
            ->getMock();

        $collector->method('executeShellCommand')->willReturn(null);

        $collector->collector();
    }

    public function testCollectThrowsExceptionOnInvalidValue(): void
    {
        $this->expectException(CollectorException::class);
        $this->expectExceptionMessage('Invalid CPU Value: -10');

        $collector = $this->getMockBuilder(CpuCollector::class)
            ->onlyMethods(['executeShellCommand'])
            ->getMock();

        $collector->method('executeShellCommand')->willReturn('110');

        $collector->collector();
    }
}
