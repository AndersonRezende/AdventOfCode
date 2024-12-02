<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Year2024\Day1;

use AdventOfCode\Year2024\Day1\HistorianHysteria;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class HistorianHysteriaTest extends TestCase {

    private static function getInputString(): string {
        return '3   4
            4   3
            2   5
            1   3
            3   9
            3   3';
    }

    public static function dataProviderLocationIdList(): Iterator {
        yield 'Location ID' => [self::getInputString(), 11];
    }

    #[DataProvider('dataProviderLocationIdList')]
    public function test_WhenAnInputStringIsGiven_ShouldReturnTheSumOfDistanceBetweenPairs(
        string $input,
        int $expected
    ): void {
        $historianHysteria = new HistorianHysteria($input);
        $historianHysteriaSumResult = $historianHysteria->sumDistanceBetweenPairs();

        $this->assertEquals($expected, $historianHysteriaSumResult);
    }

}