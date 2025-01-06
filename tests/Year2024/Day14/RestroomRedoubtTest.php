<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Year2024\Day14;

use AdventOfCode\Year2024\Day14\RestroomRedoubt;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RestroomRedoubtTest extends TestCase {

    public static function dataProviderRobotsList(): Iterator {
        yield 'Robot list 5 times' => [
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
            11, 7, 5, 12
        ];
        yield 'Robot list 100 times' => [
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
            11, 7, 100, 12
        ];
    }

    #[DataProvider('dataProviderRobotsList')]
    public function test_WhenAnInputStringIsGiven_ShouldAMatrixOfRobotsContainingPositionAndSpeed(
        string $input, int $width, int $height, int $time, int $expected
    ): void {
        $restroomRedoubt = new RestroomRedoubt($input, $width, $height);
        $securityFactor = $restroomRedoubt->calculateSecurityFactorAfterTime($time);

        $this->assertEquals($expected, $securityFactor);
    }

}