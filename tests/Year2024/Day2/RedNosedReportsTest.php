<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Year2024\Day2;

use AdventOfCode\Year2024\Day2\RedNosedReports;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RedNosedReportsTest extends TestCase {

    public static function dataProviderReport(): Iterator {
        yield 'Report 1' => [
            '7 6 4 2 1
            1 2 7 8 9
            9 7 6 2 1
            1 3 2 4 5
            8 6 4 4 1
            1 3 6 7 9',
            2
        ];
    }

    #[DataProvider('dataProviderReport')]
    public function test_WhenAnStringReportIsGiven_ShouldReturnTheNumberOfSafeReports(
        string $input, int $expected
    ): void {
        $redNosedReports = new RedNosedReports($input);
        $safeReports = $redNosedReports->calculateSafeReports();

        $this->assertEquals($expected, $safeReports);
    }

    public static function dataProviderReportWithDampener(): Iterator {
        yield 'Report 1' => [
            '7 6 4 2 1
            1 2 7 8 9
            9 7 6 2 1
            1 3 2 4 5
            8 6 4 4 1
            1 3 6 7 9',
            4
        ];
        yield 'Report 2' => ['9 4 3 2 1', 1];
        yield 'Report 3' => ['7 6 4 2 1', 1];
        yield 'Report 4' => ['1 2 7 8 9', 0];
        yield 'Report 5' => ['9 7 6 2 1', 0];
        yield 'Report 6' => ['1 2 7 8 9', 0];
        yield 'Report 7' => ['1 3 2 4 5', 1];
        yield 'Report 8' => ['8 6 4 4 1', 1];
        yield 'Report 9' => ['1 3 6 7 9', 1];
        yield 'Report 10' => ['1 3 6 7 1', 1];
        yield 'Report 11' => ['1 2 7 6 5', 0];
        yield 'Report 12' => ['19 20 24 23 24', 1];
        yield 'Report 13' => ['19 24 25 28 30', 1];
        yield 'Report 14' => ['99 97 95 93 91', 1];
        yield 'Report 15' => ['99 100 97 98 96', 0];
        yield 'Report 16' => ['99 98 100 101 103', 1];
        yield 'Report 17' => ['20 17 18 19 18 20 21 25', 0];
        yield 'Report 18' => ['1 3 4 2 1', 0];
    }

    #[DataProvider('dataProviderReportWithDampener')]
    public function test_WhenAnStringReportIsGiven_ShouldReturnTheNumberOfSafeReportsWithDampener(
        string $input, int $expected
    ): void {
        $redNosedReports = new RedNosedReports($input);
        $safeReports = $redNosedReports->calculateSafeReportsWithDampener();

        $this->assertEquals($expected, $safeReports);
    }
}