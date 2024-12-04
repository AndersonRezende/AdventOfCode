<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Year2024\Day3;

use AdventOfCode\Year2024\Day3\MullItOver;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class MullItOverTest extends TestCase {

    public static function dataProviderMemorySection(): Iterator {
        yield 'Memory section 1' => ['xmul(2,4)%&mul[3,7]!@^do_not_mul(5,5)+mul(32,64]then(mul(11,8)mul(8,5))', 161];
    }

    #[DataProvider('dataProviderMemorySection')]
    public function test_WhenAnInputStringIsGiven_ShouldReturnTheSumOfValidMultiplications(
        string $input,
        int $expected
    ): void {
        $mullItOver = new MullItOver($input);
        $sumOfValidMultiplications = $mullItOver->calculate();

        $this->assertEquals($expected, $sumOfValidMultiplications);
    }
}