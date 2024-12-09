<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Year2024\Day7;

use AdventOfCode\Year2024\Day7\BridgeRepairInputResolver;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class BridgeRepairInputResolverTest extends TestCase {

    public static function dataProviderTestValue(): Iterator {
        yield 'Operation 1' => [
            BridgeRepairUtils::getBridgeRepairOperations(),
            [
                [190, [10, 19]],
                [3267, [81, 40, 27]],
                [83, [17, 5]],
                [156, [15, 6]],
                [7290, [6, 8, 6, 15]],
                [161011, [16, 10, 13]],
                [192, [17, 8, 14]],
                [21037, [9, 7, 18, 13]],
                [292, [11, 6, 16, 20]],
            ]
        ];
    }

    #[DataProvider('dataProviderTestValue')]
    public function test_WhenAnInputStringIsGiven_ShouldReturnTheTestValue(
        string $input,
        array $expected
    ): void {
        $operations = BridgeRepairInputResolver::extractValues($input);

        $this->assertEquals($expected, $operations);
    }
}