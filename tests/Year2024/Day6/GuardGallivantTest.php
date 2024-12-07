<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Year2024\Day6;

use AdventOfCode\Year2024\Day6\GuardGallivant;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class GuardGallivantTest extends TestCase {

    public static function dataProviderInputWords(): Iterator {
        yield 'Start map' => [
            GuardGallivantUtils::getStartMapString(),
            41
        ];
        yield 'Surrounded map' => [
            GuardGallivantUtils::getSurroundedMapString(),
            3
        ];
    }

    #[DataProvider('dataProviderInputWords')]
    public function test_WhenAnInputStringIsGiven_ShouldReturnTheNumberOfWordsContainingXMAS(
        string $input,
        int $expected
    ): void {
        $guardGallivant = new GuardGallivant($input);
        $numberOfPositionsBeforeLeaveMappedArea = $guardGallivant->countPositionsBeforeLeaveMappedArea();

        $this->assertEquals($expected, $numberOfPositionsBeforeLeaveMappedArea);
    }

}