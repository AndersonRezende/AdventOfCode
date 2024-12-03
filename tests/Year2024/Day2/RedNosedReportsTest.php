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
}