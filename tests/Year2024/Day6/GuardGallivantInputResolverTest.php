<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Year2024\Day6;

use AdventOfCode\Year2024\Day6\GuardGallivantInputResolver;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class GuardGallivantInputResolverTest extends TestCase {

    public static function dataProviderStartMap(): Iterator {
        yield 'Word list' => [
            GuardGallivantUtils::getStartMapString(),
            GuardGallivantUtils::getStartMapArray(),
        ];
    }

    #[DataProvider('dataProviderStartMap')]
    public function test_WhenAnInputStringIsGiven_ShouldReturnTheNumberOfWordsContainingXMAS(
        string $input,
        array $expected
    ): void {
        $guardGallivantArrayMap = GuardGallivantInputResolver::convertToArrayMap($input);

        $this->assertEquals($expected, $guardGallivantArrayMap);
    }

    public static function dataProviderGuardPositionAtMap(): Iterator {
        yield 'Word list' => [GuardGallivantUtils::getStartMapArray(), [6,4]];
    }

    #[DataProvider('dataProviderGuardPositionAtMap')]
    public function test_WhenAnInputStringIsGiven_ShouldReturnInWhatPositionTheGuardIsAtTheBeginning(
        array $input,
        array $expected
    ): void {
        $guardGallivantStartGuardPosition = GuardGallivantInputResolver::getGuardPosition($input);

        $this->assertEquals($expected, $guardGallivantStartGuardPosition);
    }
}