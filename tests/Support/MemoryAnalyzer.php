<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Support;

class MemoryAnalyzer {

    private int $startMemory;
    private int $startPeakMemory;
    private float|string $startTime;
    private int $endMemory;
    private int $endPeakMemory;
    private float|string $endTime;

    public function startAnalyze(): void {
        $this->startPeakMemory = memory_get_peak_usage();
        $this->startTime = microtime(true);
    }

    public function endAnalyze(): void {
        $this->endPeakMemory = memory_get_peak_usage();
        $this->endTime = microtime(true);
    }

    public function getPerformanceResults(): array {
        [$executionTime, $peakMemoryUsage] = $this->calculatePerformance();
        return [
            $executionTime,
            $peakMemoryUsage / 1024 / 1024,
        ];
    }

    public function printPerformance(): void {
        $timesToRepeatDivisorCharacter = 50;
        [$executionTime, $peakMemoryUsage] = $this->calculatePerformance();
        echo str_repeat('-', $timesToRepeatDivisorCharacter) . PHP_EOL;
        echo $executionTime . ' s' . PHP_EOL;
        echo $peakMemoryUsage . ' MB' . PHP_EOL;
        echo str_repeat('-', $timesToRepeatDivisorCharacter) . PHP_EOL;
        echo PHP_EOL;
    }

    private function calculatePerformance(): array {
        return [
            ($this->endTime - $this->startTime),
            ($this->endPeakMemory - $this->startPeakMemory) / 1024 / 1024,
        ];
    }
}