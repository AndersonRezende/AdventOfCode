<?php declare(strict_types = 1);

namespace AdventOfCode\Tests\Year2023\Day1;

use Iterator;
use AdventOfCode\Year2023\Day1\Trebuchet;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class TrebuchetTest extends TestCase {

    #[DataProvider('dataProviderSumCalibrationValueToDecode')]
    public function test_WhenEncodedInputIsGiven_ShouldReturnCalibrationValueSum(
        array $encodedTextList,
        int $expectedSum
    ): void {
        $trebuchet = new Trebuchet();
        $sum = $trebuchet->sumCalibrationValues($encodedTextList);
        $this->assertEquals($expectedSum, $sum);
    }

    #[DataProvider('dataProviderCalibrationValueToDecode')]
    public function test_WhenEncodedTextIsGiven_ShouldReturnCalibrationValue(
        string $encodedText,
        int $expectedDecodedValue
    ): void {
        $trebuchet = new Trebuchet();
        $calibrationValue = $trebuchet->decodeCalibrationValue($encodedText);
        $this->assertEquals($expectedDecodedValue, $calibrationValue);
    }

    public static function dataProviderCalibrationValueToDecode(): Iterator {
        yield 'Two numbers at the beginning and at the end' => ['1abc2', 12];
        yield 'Two numbers after the beginning and before the end' => ['pqr3stu8vwx', 38];
        yield 'Five numbers separated by letters' => ['a1b2c3d4e5f', 15];
        yield 'One number at the middle of string' => ['treb7uchet', 77];
        yield 'One number at the beginning of string' => ['1abc', 11];
        yield 'One number at the end of string' => ['abc2', 22];
        yield 'Two numbers at the end of string' => ['abc23', 23];
        yield 'Two numbers at the beginning of string' => ['99abc', 99];
        yield 'Three numbers at the beginning of string' => ['939abc', 99];
        yield 'String with spelled numbers, random chars and digits' => ['onetest99abc', 19];
        yield 'Two spelled numbers sharing the same char' => ['twonetest99abc', 29];
        yield 'Two spelled numbers sharing the same char, first bigger than first' => ['sevenine', 79];
        yield 'Two spelled numbers sharing the same char, first smaller than first' => ['oneight', 18];
    }

    public static function dataProviderSumCalibrationValueToDecode(): Iterator {
        yield 'Should sum 12 + 38 + 15 + 77' => [['1abc2', 'pqr3stu8vwx', 'a1b2c3d4e5f', 'treb7uchet'], 142];
        yield 'Should sum 12 + 34 + 56 + 78 + 99' => [['one2', 'athreebfour', '5ssix', '7nine8', '9nine'], 279];
        yield 'Should sum 99' => [['ab9cd'], 99];
    }
}