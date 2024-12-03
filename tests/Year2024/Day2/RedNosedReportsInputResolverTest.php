<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Year2024\Day2;

use AdventOfCode\Year2024\Day2\RedNosedReportsInputResolver;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RedNosedReportsInputResolverTest extends TestCase {

    public static function dataProviderReport(): Iterator {
        yield 'Report 1' => [
            '7 6 4 2 1
            1 2 7 8 9
            9 7 6 2 1
            1 3 2 4 5
            8 6 4 4 1
            1 3 6 7 9',
            [
                [7, 6, 4, 2, 1],
                [1, 2, 7, 8, 9],
                [9, 7, 6, 2, 1],
                [1, 3, 2, 4, 5],
                [8, 6, 4, 4, 1],
                [1, 3, 6, 7, 9]
            ]
        ];
    }

    #[DataProvider('dataProviderReport')]
    public function test_WhenAnInputStringIsGiven_ShouldReturnAMatrixContainingStringNumbers(
        string $input,
        array $expected
    ): void {
        $redNosedReportsMatrix = RedNosedReportsInputResolver::convertToMatrix($input);

        $this->assertEquals($expected, $redNosedReportsMatrix);
    }
}