<?php

declare(strict_types=1);

namespace Tests\Unit\Collectors;

use App\Collectors\MemoryCollector;
use App\Exceptions\CollectorException;
use PHPUnit\Framework\TestCase;

class MemoryCollectorTest extends TestCase
{
    public function testCollectReturnsValidMemoryUsage(): void
    {
        $collector = $this->getMockBuilder(MemoryCollector::class)
            ->onlyMethods(['executeShellCommand'])
            ->getMock();

        $collector->method('executeShellCommand')->willReturn('75');

        $memoryUsage = $collector->collector();

        $this->assertIsFloat($memoryUsage);
        $this->assertEquals(75.0, $memoryUsage);
    }

    public function testCollectThrowsExceptionOnCommandFailure(): void
    {
        $this->expectException(CollectorException::class);
        $this->expectExceptionMessage('Failed to execute shell command.');

        $collector = $this->getMockBuilder(MemoryCollector::class)
            ->onlyMethods(['executeShellCommand'])
            ->getMock();

        $collector->method('executeShellCommand')->willReturn(null);

        $collector->collector();
    }

    public function testCollectThrowsExceptionOnInvalidValue(): void
    {
        $this->expectException(CollectorException::class);
        $this->expectExceptionMessage('Invalid memory value: 110');

        $collector = $this->getMockBuilder(MemoryCollector::class)
            ->onlyMethods(['executeShellCommand'])
            ->getMock();

        $collector->method('executeShellCommand')->willReturn('110');

        $collector->collector();
    }
}
