<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day15;

use AdventOfCode\Utils\Direction;

class WarehouseWoes {

    private array $warehouseMap = [];
    private array $robotMovements = [];
    private RobotPosition $robotPosition;

    public function __construct(private readonly string $input) {
        $this->initializeWarehouse();
    }

    public function sumOfAllBoxesAfterMovements(): int {
        $warehouseFinalMap = $this->getFinalMap();
        return $this->calculateSumOfFinalBoxesPosition($warehouseFinalMap);
    }

    private function initializeWarehouse(): void {
        $warehouseInputResolver = new WarehouseWoesInputResolver($this->input);
        $this->warehouseMap = $warehouseInputResolver->getWarehouseMap();
        $this->robotMovements = $warehouseInputResolver->getRobotMovements();
        [$robotXPosition, $robotYPosition] = $warehouseInputResolver->getRobotPosition();
        $this->robotPosition = new RobotPosition($robotXPosition, $robotYPosition);
    }

    private function getFinalMap(): array {
        $map = $this->warehouseMap;
        foreach ($this->robotMovements as $movement) {
            $map = $this->processMovement($map, $movement);
        }
        return $map;
    }

    private function processMovement(array $map, Direction $direction): array {
        [$x, $y] = $this->getMovementDelta($direction);

        $newX = $this->robotPosition->x + $x;
        $newY = $this->robotPosition->y + $y;

        if ($this->isPositionWithinBounds($newX, $newY)) {
            $map = $this->updateMapWithMovement($map, $newX, $newY, $x, $y);
        }

        return $map;
    }

    private function getMovementDelta(Direction $direction): array {
        return match ($direction) {
            Direction::UP => [-1, 0],
            Direction::DOWN => [1, 0],
            Direction::LEFT => [0, -1],
            Direction::RIGHT => [0, 1],
        };
    }

    private function updateMapWithMovement(array $map, int $newX, int $newY, int $x, int $y): array {
        if ($map[$newX][$newY] === '.') {
            $this->moveRobotToEmptySpace($map, $newX, $newY);
        } elseif ($map[$newX][$newY] === 'O') {
            $map = $this->moveBoxAndRobot($map, $newX, $newY, $x, $y);
        }
        return $map;
    }

    private function moveRobotToEmptySpace(array &$map, int $newX, int $newY): void {
        $map[$this->robotPosition->x][$this->robotPosition->y] = '.';
        $map[$newX][$newY] = '@';
        $this->robotPosition = new RobotPosition($newX, $newY);
    }

    private function moveBoxAndRobot(array $map, int $newX, int $newY, int $x, int $y): array {
        $nextX = $newX + $x;
        $nextY = $newY + $y;
        while ($this->isPositionWithinBounds($nextX, $nextY) && $map[$nextX][$nextY] === 'O') {
            $nextX += $x;
            $nextY += $y;
        }
        if ($this->isPositionWithinBounds($nextX, $nextY) && $map[$nextX][$nextY] === '.') {
            $this->moveRobotToEmptySpace($map, $newX, $newY);
            $map[$nextX][$nextY] = 'O';
        }
        return $map;
    }

    private function isPositionWithinBounds(int $row, int $column): bool {
        return $this->isWithinBounds($row, count($this->warehouseMap))
            && $this->isWithinBounds($column, count($this->warehouseMap[0]));
    }

    private function isWithinBounds(int $position, int $limit): bool {
        return $position >= 0 && $position < $limit;
    }

    private function calculateSumOfFinalBoxesPosition(array $warehouseFinalMap): int {
        $sum = 0;
        foreach ($warehouseFinalMap as $row => $columns) {
            foreach ($columns as $column => $cell) {
                if ($cell === 'O') {
                    $sum += 100 * $row + $column;
                }
            }
        }
        return $sum;
    }
}