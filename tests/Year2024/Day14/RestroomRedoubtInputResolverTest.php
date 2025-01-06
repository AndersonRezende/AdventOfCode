<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Year2024\Day14;

use AdventOfCode\Year2024\Day14\RestroomRedoubtInputResolver;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RestroomRedoubtInputResolverTest extends TestCase {

    public static function dataProviderRobotsList(): Iterator {
        yield 'Robot list' => [
            'p=0,4 v=3,-3
            p=6,3 v=-1,-3
            p=10,3 v=-1,2
            p=2,0 v=2,-1
            p=0,0 v=1,3
            p=3,0 v=-2,-2
            p=7,6 v=-1,-3
            p=3,0 v=-1,-2
            p=9,3 v=2,3
            p=7,3 v=-1,2
            p=2,4 v=2,-3
            p=9,5 v=-3,-3',
            [
                [[0, 4], [3, -3]],
                [[6, 3], [-1, -3]],
                [[10, 3], [-1, 2]],
                [[2, 0], [2, -1]],
                [[0, 0], [1, 3]],
                [[3, 0], [-2, -2]],
                [[7, 6], [-1, -3]],
                [[3, 0], [-1, -2]],
                [[9, 3], [2, 3]],
                [[7, 3], [-1, 2]],
                [[2, 4], [2, -3]],
                [[9, 5], [-3, -3]],
            ]
        ];
    }

    #[DataProvider('dataProviderRobotsList')]
    public function test_WhenAnInputStringIsGiven_ShouldAMatrixOfRobotsContainingPositionAndSpeed(
        string $input,
        array $expected
    ): void {
        $robots = RestroomRedoubtInputResolver::extractRobots($input);

        $this->assertEquals($expected, $robots);
    }
}