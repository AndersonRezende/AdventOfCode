<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day6;

use AdventOfCode\Utils\Direction;

class GuardGallivant {

    private array $arrayMap = [];
    private int $rowLimit;
    private int $columnLimit;
    private int $guardRow;
    private int $guardColumn;
    private Direction $guardDirection;

    public function __construct(private readonly string $input) {
        $this->arrayMap = GuardGallivantInputResolver::convertToArrayMap($this->input);
        $this->rowLimit = sizeof($this->arrayMap);
        $this->columnLimit = sizeof($this->arrayMap[0]);
        [$this->guardRow, $this->guardColumn] = GuardGallivantInputResolver::getGuardPosition($this->arrayMap);
        $this->guardDirection = Direction::getDirection($this->arrayMap[$this->guardRow][$this->guardColumn]);
    }

    public function countPositionsBeforeLeaveMappedArea(): int {
        $list["$this->guardRow.$this->guardColumn"] = '';
        while ($this->moveGuard()) {
            $list["$this->guardRow.$this->guardColumn"] = '';
        }
        return count($list) ;
    }

    private function MoveGuard(): bool {
        while ($this->shouldAdjustDirection()) {
            $this->adjustDirection();
        }
        return $this->nextGuardMove();
    }

    private function nextGuardMove(): bool {
        [$row, $column] = $this->nextRowColumnPosition();
        if ($this->isValidPosition($row, $column)) {
            $this->guardRow = $row;
            $this->guardColumn = $column;
            return true;
        }
        return false;
    }

    private function shouldAdjustDirection(): bool {
        [$row, $column] = $this->nextRowColumnPosition();
        if ($this->isValidPosition($row, $column) && $this->isCollision($row, $column)) {
            return true;
        }
        return false;
    }

    private function adjustDirection(): void {
        $this->guardDirection = Direction::turnRight($this->guardDirection);
    }

    private function nextRowColumnPosition(): array {
        $row = $this->guardRow;
        $column = $this->guardColumn;
        switch ($this->guardDirection) {
            case Direction::UP:
                $row--;
                break;
            case Direction::DOWN:
                $row++;
                break;
            case Direction::LEFT:
                $column--;
                break;
            case Direction::RIGHT:
                $column++;
                break;
        }
        return [$row, $column];
    }

    private function isValidPosition(int $row, int $column): bool {
        return $row >= 0 && $row < $this->rowLimit && $column >= 0 && $column < $this->columnLimit;
    }

    private function isCollision(int $row, int $column): bool {
        return $this->arrayMap[$row][$column] == '#';
    }
}