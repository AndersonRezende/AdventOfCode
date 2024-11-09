<?php

declare(strict_types = 1);

namespace AdventOfCode\Tests\Year2023\Day3;

use AdventOfCode\Year2023\Day3\GearRatios;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class GearRatiosTest extends TestCase {
    
    #[DataProvider('dataProviderEngineSchematicMatrix')]
    public function test_WhenAMatrixContainingContainingNumbersAndSymbolsIsGiven_ShouldSumTheValuesAdjacentToASymbol(
        array $matrix,
        int $expected
    ): void {
        $gearRatios = new GearRatios($matrix);
        $sum = $gearRatios->sumValuesAdjacentToSymbols();

        $this->assertEquals($expected, $sum);
    }

    #[DataProvider('dataProviderEngineSchematicMatrixGearRatio')]
    public function test_WhenAMatrixContainingContainingNumbersAndSymbolsIsGiven_ShouldSumTheMultiplyValuesAdjacentToAnAsterisk(
        array $matrix,
        int $expected
    ): void {
        $gearRatios = new GearRatios($matrix);
        $sum = $gearRatios->sumAllGearRatios();

        $this->assertEquals($expected, $sum);
    }

    public static function dataProviderEngineSchematicMatrix(): Iterator {
        yield 'Engine schematic' => [
            [
                ['4','6','7','.','.','1','1','4','.','.'],
                ['.','.','.','*','.','.','.','.','.','.'],
                ['.','.','3','5','.','.','6','3','3','.'],
                ['.','.','.','.','.','.','#','.','.','.'],
                ['6','1','7','*','.','.','.','.','.','.'],
                ['.','.','.','.','.','+','.','5','8','.'],
                ['.','.','5','9','2','.','.','.','.','.'],
                ['.','.','.','.','.','.','7','5','5','.'],
                ['.','.','.','$','.','*','.','.','.','.'],
                ['.','6','6','4','.','5','9','8','.','.'],
            ],
            4361
        ];
    }

    public static function dataProviderEngineSchematicMatrixGearRatio(): Iterator {
        yield 'Engine schematic' => [
            [
                ['4','6','7','.','.','1','1','4','.','.'],
                ['.','.','.','*','.','.','.','.','.','.'],
                ['.','.','3','5','.','.','6','3','3','.'],
                ['.','.','.','.','.','.','#','.','.','.'],
                ['6','1','7','*','.','.','.','.','.','.'],
                ['.','.','.','.','.','+','.','5','8','.'],
                ['.','.','5','9','2','.','.','.','.','.'],
                ['.','.','.','.','.','.','7','5','5','.'],
                ['.','.','.','$','.','*','.','.','.','.'],
                ['.','6','6','4','.','5','9','8','.','.'],
            ],
            467835
        ];
    }
}