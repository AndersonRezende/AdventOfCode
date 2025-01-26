<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Year2024\Day15;

use AdventOfCode\Utils\Direction;
use AdventOfCode\Year2024\Day15\WarehouseWoesInputResolver;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class WarehouseWoesInputResolverTest extends TestCase {

    public static function dataProviderWarehouseWoes(): Iterator {
        yield 'Warehouse 1' => [
            "########
#..O.O.#
##@.O..#
#...O..#
#.#.O..#
#...O..#
#......#
########

<^^>>>vv<v>>v<<",
            [
                ['#','#','#','#','#','#','#','#'],
                ['#','.','.','O','.','O','.','#'],
                ['#','#','@','.','O','.','.','#'],
                ['#','.','.','.','O','.','.','#'],
                ['#','.','#','.','O','.','.','#'],
                ['#','.','.','.','O','.','.','#'],
                ['#','.','.','.','.','.','.','#'],
                ['#','#','#','#','#','#','#','#']
            ],
            [
                Direction::LEFT, Direction::UP, Direction::UP, Direction::RIGHT, Direction::RIGHT, Direction::RIGHT,
                Direction::DOWN, Direction::DOWN, Direction::LEFT, Direction::DOWN, Direction::RIGHT, Direction::RIGHT,
                Direction::DOWN, Direction::LEFT, Direction::LEFT,
            ],
            [2, 2]
        ];
    }

    #[DataProvider('dataProviderWarehouseWoes')]
    public function test_WhenAnInputStringIsGiven_ShouldAMatrixOfRobotsContainingPositionAndSpeed(
        string $input,
        array $expectedWarehouseMap,
        array $expectedRobotMovements,
        array $expectedRobotPosition
    ): void {
        $warehouseWoesInputResolver = new WarehouseWoesInputResolver($input);
        $warehouseMap = $warehouseWoesInputResolver->getWarehouseMap();
        $robotMoves = $warehouseWoesInputResolver->getRobotMovements();
        $robotPosition = $warehouseWoesInputResolver->getRobotPosition();

        $this->assertEquals($expectedWarehouseMap, $warehouseMap);
        $this->assertEquals($expectedRobotMovements, $robotMoves);
        $this->assertEquals($expectedRobotPosition, $robotPosition);
    }
}