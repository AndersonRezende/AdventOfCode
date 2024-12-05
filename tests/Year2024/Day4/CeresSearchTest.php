<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Year2024\Day4;

use AdventOfCode\Year2024\Day4\CeresSearch;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CeresSearchTest extends TestCase {

    public static function getWordList(): string {
        return 'MMMSXXMASM
            MSAMXMSMSA
            AMXSXMAAMM
            MSAMASMSMX
            XMASAMXAMM
            XXAMMXXAMA
            SMSMSASXSS
            SAXAMASAAA
            MAMMMXMMMM
            MXMXAXMASX';
    }

    public static function dataProviderInputWords(): Iterator {
        yield 'Word list' => [
            self::getWordList(),
            18
        ];
    }

    #[DataProvider('dataProviderInputWords')]
    public function test_WhenAnInputStringIsGiven_ShouldReturnTheNumberOfWordsContainingXMAS(
        string $input,
        int $expected
    ): void {
        $ceresSearch = new CeresSearch($input);
        $xmasWordCount = $ceresSearch->countXmasWords();

        $this->assertEquals($expected, $xmasWordCount);
    }

    public static function dataProviderInputWordsInXFormatContainingMas(): Iterator {
        yield 'Word list' => [
            self::getWordList(),
            9
        ];
    }

    #[DataProvider('dataProviderInputWordsInXFormatContainingMas')]
    public function test_WhenAnInputStringIsGiven_ShouldReturnTheNumberOfWordsContainingMASInXFormat(
        string $input,
        int $expected
    ): void {
        $ceresSearch = new CeresSearch($input);
        $xmasWordCount = $ceresSearch->countMASWordsInXFormat();

        $this->assertEquals($expected, $xmasWordCount);
    }
}