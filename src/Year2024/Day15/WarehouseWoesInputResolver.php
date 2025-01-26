<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day15;

use AdventOfCode\Utils\Direction;

class WarehouseWoesInputResolver {

    private array $warehouseMap = [];
    private array $robotMovements = [];
    private array $robotPosition = [];

    public function __construct(string $input) {
        [$mapString, $robotCommands] = explode("\n\n", $input);
        $this->parseWarehouseMap($mapString);
        $this->parseRobotMovements($robotCommands);
    }

    public function getWarehouseMap(): array {
        return $this->warehouseMap;
    }

    public function getRobotMovements(): array {
        return $this->robotMovements;
    }

    public function getRobotPosition(): array {
        return $this->robotPosition;
    }

    private function parseWarehouseMap(string $mapString): void {
        $rows = explode(PHP_EOL, $mapString);
        foreach ($rows as $y => $row) {
            $this->warehouseMap[$y] = str_split($row);
            $this->setRobotInitialPosition($row, $y);
        }
    }

    private function setRobotInitialPosition(string $row, int $y): void {
        if (strpos($row, '@') !== false) {
            $x = strpos($row, '@');
            $this->robotPosition = [$y, $x];
        }
    }

    private function parseRobotMovements(string $robotCommands): void {
        $commands = str_split(str_replace(PHP_EOL, '', $robotCommands));
        foreach ($commands as $command) {
            $direction = Direction::getDirection($command);
            $this->robotMovements[] = $direction;
        }
    }
}