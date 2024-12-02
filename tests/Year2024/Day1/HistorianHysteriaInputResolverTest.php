<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Year2024\Day1;

use AdventOfCode\Year2024\Day1\HistorianHysteriaInputResolver;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class HistorianHysteriaInputResolverTest extends TestCase {

    public static function dataProviderLocationIdList(): Iterator {
        yield 'Location ID' => [
            '3   4
            4   3
            2   5
            1   3
            3   9
            3   3',
            [[3, 4, 2, 1, 3, 3], [4, 3, 5, 3, 9, 3]]
        ];
    }

    #[DataProvider('dataProviderLocationIdList')]
    public function test_WhenAInputStringIsGiven_ShouldReturnAnArrayContainingTheListOfLocationId(
        string $input,
        array $expected
    ): void {
        $locationId = HistorianHysteriaInputResolver::processLists($input);

        $this->assertEquals($expected, $locationId);
    }
    
}