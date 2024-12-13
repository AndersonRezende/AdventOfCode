<?php

namespace AdventOfCode\Tests\Year2024\Day11;

use AdventOfCode\Year2024\Day11\PlutonianPebbles;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class PlutonianPebblesTest extends TestCase {

    public static function dataProviderStoneBlink(): Iterator {
        yield 'Stones blink 1' => ['0 1 10 99 999', 1, 7];
        yield 'Stones blink 2' => ['125 17', 6, 22];
        yield 'Stones blink 3' => ['125 17', 25, 55312];
        yield 'Stones blink 4' => ['7725 185 2 132869 0 1840437 62 26310', 25, 233050];
    }

    #[DataProvider('dataProviderStoneBlink')]
    public function test_WhenAnInputStringContainingAStoneArrangementIsGiven_ShouldReturnTheNumberOfStonesAfterBlinking(
        string $input,
        int $blinkingTimes,
        int $expected
    ): void {
        $plutonianPebbles = new PlutonianPebbles();
        $stonesResult = $plutonianPebbles->calculateHowManyStonesAfterBlinking($input, $blinkingTimes);

        $this->assertEquals($expected, $stonesResult);
    }
}