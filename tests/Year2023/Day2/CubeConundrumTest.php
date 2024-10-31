<?php

namespace AdventOfCode\Tests\Year2023\Day2;

use AdventOfCode\Year2023\Day2\CubeConundrum;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CubeConundrumTest extends TestCase {

    /** Part 1 of the challenge */
    #[DataProvider('dataProviderCheckIfGameIsPossible')]
    public function test_WhenStringInputAndCubeColorsNumbersAreGiven_ShouldCheckIfGameIsValid(
        string $gameRecord,
        array $cubeColorsNumbersRequirements,
        bool $expected
    ): void {
        $cubeConundrum = new CubeConundrum();
        $isGameValid = $cubeConundrum->checkIfGameIsValid($gameRecord, $cubeColorsNumbersRequirements);

        $this->assertSame($expected, $isGameValid);
    }

    #[DataProvider('dataProviderSumIndexOfValidGames')]
    public function test_WhenAGameRecordListIsGiven_ShouldSumTheIndexOfValidGames(
        array $gameRecordList,
        array $cubeColorsNumbersRequirements,
        int $expected
    ): void {
        $cubeConundrum = new CubeConundrum();
        $resultSumValidGames = $cubeConundrum->sumValidGameIds($gameRecordList, $cubeColorsNumbersRequirements);

        $this->assertEquals($expected, $resultSumValidGames);
    }

    public static function dataProviderCheckIfGameIsPossible(): Iterator {
        yield 'Game 1' => [
            'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green',
            ['red' => 12, 'green' => 13, 'blue' => 14],
            true
        ];
        yield 'Game 2' => [
            'Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue',
            ['red' => 12, 'green' => 13, 'blue' => 14],
            true
        ];
        yield 'Game 3' => [
            'Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red',
            ['red' => 12, 'green' => 13, 'blue' => 14],
            false
        ];
        yield 'Game 4' => [
            'Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red',
            ['red' => 12, 'green' => 13, 'blue' => 14],
            false
        ];
        yield 'Game 5' => [
            'Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green',
            ['red' => 12, 'green' => 13, 'blue' => 14],
            true
        ];
    }

    public static function dataProviderSumIndexOfValidGames(): Iterator {
        yield 'Game 1' => [
            [
                'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green',
                'Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue',
                'Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red',
                'Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red',
                'Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green',
            ],
            ['red' => 12, 'green' => 13, 'blue' => 14],
            8
        ];
    }


    /** Part 2 of the challenge */
    #[DataProvider('dataProviderMinimumColorQuantityToBeValid')]
    public function test_WhenStringInputIsGiven_ShouldReturnLargestNumberOfEachColor(
        string $gameRecord,
        array $expected
    ): void {
        $cubeConundrum = new CubeConundrum();
        $largestColorsNumbers = $cubeConundrum->minimumColorQuantityNecessaryToBeValid($gameRecord);

        $this->assertEquals($expected, $largestColorsNumbers);
    }

    #[DataProvider('dataProviderSumOfThePowersOfTheLargestQuantitiesOfEachColor')]
    public function test_WhenAnArrayContainingGameRecordsIsGiven_ShouldSumThePowerOfTheLargestQuantitiesOfEachColor(
        array $gameRecordList,
        int $expected
    ): void {
        $cubeConundrum = new CubeConundrum();
        $powerSum = $cubeConundrum->sumOfGamePowerList($gameRecordList);

        $this->assertEquals($expected, $powerSum);
    }

    public static function dataProviderMinimumColorQuantityToBeValid(): Iterator {
        yield 'Game 1' => [
            'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green',
            ['red' => 4, 'green' => 2, 'blue' => 6]
        ];
        yield 'Game 2' => [
            'Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue',
            ['red' => 1, 'green' => 3, 'blue' => 4]
        ];
        yield 'Game 3' => [
            'Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red',
            ['red' => 20, 'green' => 13, 'blue' => 6]
        ];
        yield 'Game 4' => [
            'Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red',
            ['red' => 14, 'green' => 3, 'blue' => 15]
        ];
        yield 'Game 5' => [
            'Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green',
            ['red' => 6, 'green' => 3, 'blue' => 2]
        ];
    }

    public static function dataProviderSumOfThePowersOfTheLargestQuantitiesOfEachColor(): Iterator {
        yield 'Game 1' => [
            [
                'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green',
                'Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue',
                'Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red',
                'Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red',
                'Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green',
            ],
            2286
        ];
    }
}