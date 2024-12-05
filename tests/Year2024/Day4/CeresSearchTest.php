<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Year2024\Day4;

use AdventOfCode\Year2024\Day4\CeresSearch;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CeresSearchTest extends TestCase {

    public static function dataProviderInputWords(): Iterator {
        yield 'Memory section 1' => [
            'MMMSXXMASM
            MSAMXMSMSA
            AMXSXMAAMM
            MSAMASMSMX
            XMASAMXAMM
            XXAMMXXAMA
            SMSMSASXSS
            SAXAMASAAA
            MAMMMXMMMM
            MXMXAXMASX',
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
}