<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Year2024\Day7;

use AdventOfCode\Year2024\Day7\BridgeRepair;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class BridgeRepairTest extends TestCase {

    public static function dataProviderMemorySection(): Iterator {
        yield 'Operation 1' => [
            BridgeRepairUtils::getBridgeRepairOperations(),
            11387
        ];
    }

    #[DataProvider('dataProviderMemorySection')]
    public function test_WhenAnInputStringIsGiven_ShouldReturnTheSumOfValidMultiplications(
        string $input,
        int $expected
    ): void {
        $bridgeRepair = new BridgeRepair($input);
        $sumTestValuesOfPossiblesEquations = $bridgeRepair->sumTestValuesOfPossiblesEquations();

        $this->assertEquals($expected, $sumTestValuesOfPossiblesEquations);
    }
}