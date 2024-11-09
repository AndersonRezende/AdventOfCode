<?php

declare(strict_types = 1);

namespace AdventOfCode\Year2023\Day3;

class GearRatios {
    private const string ONLY_NUMBERS_PATTERN = '/\d+/';
    private const string ONLY_ASTERISK_PATTERN = '/\*/';
    private int $offset;
    private int $stringMatrixLength;
    private string $stringMatrix;
    private array $numbersAndPositions;

    public function __construct(private readonly array $matrix) {
        $this->offset = sizeof($this->matrix[0]);
        $this->stringMatrix = $this->implodeMatrix($this->matrix);
        $this->stringMatrixLength = strlen($this->stringMatrix);
        $this->numbersAndPositions = $this->matchNumbersAndPositionsFromMatrix();
    }

    private function implodeMatrix(array $matrix): string {
        return implode('', array_map(fn($line) => implode('', $line), $matrix));
    }

    private function matchNumbersAndPositionsFromMatrix(): array {
        preg_match_all(self::ONLY_NUMBERS_PATTERN, $this->stringMatrix, $matches, PREG_OFFSET_CAPTURE);
        return $matches[0];
    }

    /** Part 1 of the challenge */
    public function sumValuesAdjacentToSymbols(): int {
        $sum = 0;
        foreach ($this->numbersAndPositions as $numberPosition) {
            $digitQuantity = strlen($numberPosition[0]);
            $baseIndex = $numberPosition[1];
            if ($this->isNumberAdjacentToSymbol($digitQuantity, $baseIndex)) {
                $sum += intval($numberPosition[0]);
            }
        }

        return $sum;
    }

    private function isNumberAdjacentToSymbol(int $digitQuantity, int $baseIndex): bool {
        for ($offset = 0; $offset < $digitQuantity; $offset++) {
            if ($this->isDigitAdjacentToSymbol($baseIndex + $offset)) {
                return true;
            }
        }
        return false;
    }

    private function isDigitAdjacentToSymbol(int $index): bool {
        $positionsToCheck = $this->filterPositionsToCheckBasedOnAdjacentIndexes($index);
        $matrixLength = $this->stringMatrixLength;
        $validPositionsToCheck = array_keys(array_filter($positionsToCheck, function($value) use ($matrixLength) {
            return $value >= 0 && $value < $matrixLength;
        }));

        foreach ($validPositionsToCheck as $position) {
            $index = $positionsToCheck[$position];
            if ($this->isValidSymbol($this->stringMatrix[$index])) {
                return true;
            }
        }
        return false;
    }

    private function isValidSymbol(string $char): bool {
        return $char !== '.' && !is_numeric($char);
    }

    private function filterPositionsToCheckBasedOnAdjacentIndexes($index): array {
        $adjacentPositions = [
            'left' => $index - 1,
            'right' => $index + 1,
            'topLeft' => $index - $this->offset - 1,
            'top' => $index - $this->offset,
            'topRight' => $index - $this->offset + 1,
            'bottomLeft' => $index + $this->offset - 1,
            'bottom' => $index + $this->offset,
            'bottomRight' => $index + $this->offset + 1
        ];
        $matrixLength = $this->stringMatrixLength;
        return array_filter($adjacentPositions, function($value) use ($matrixLength) {
            return $value >= 0 && $value < $matrixLength;
        });
    }

    /** Part 2 of the challenge */
    public function sumAllGearRatios(): int {
        $gears = $this->findGears();
        $calculateGearRatios = $this->calculateGearRatios($gears);
        return $calculateGearRatios;
    }

    private function findGears(): array {
        preg_match_all(self::ONLY_ASTERISK_PATTERN, $this->stringMatrix, $matches, PREG_OFFSET_CAPTURE);
        $supposedGears = array_column($matches[0], 1);
        $supposedGears = $this->addMappingOfAdjacentNumbersToGears($supposedGears);
        return $this->filterValidGears($supposedGears);
    }

    private function addMappingOfAdjacentNumbersToGears(array $gears): array {
        for ($i = 0; $i < sizeof($gears); $i++) {
            $gears[$i] = $this->addMappingOfAdjacentNumbersToGear($gears[$i]);
        }
        return $gears;
    }

    private function addMappingOfAdjacentNumbersToGear(int $gearIndex): array {
        $validPositionsToCheck = $this->filterPositionsToCheckBasedOnAdjacentIndexes($gearIndex);
        $validPositionsToCheck = $this->filterPositionsWithNumbers($validPositionsToCheck);
        $mapperOfAdjacentNumbersToGear = [];
        foreach ($validPositionsToCheck as $position) {
            $numberFromPosition = $this->getStartIndexAndNumberFromIndex($position);
            $mapperOfAdjacentNumbersToGear[$numberFromPosition[0]] = $numberFromPosition[1];
        }
        return $mapperOfAdjacentNumbersToGear;
    }

    private function filterPositionsWithNumbers(array $positionsToCheck): array {
        return array_filter($positionsToCheck, function ($position) {
            return is_numeric($this->stringMatrix[$position]);
        });
    }

    private function getStartIndexAndNumberFromIndex(int $position): array {
        foreach ($this->numbersAndPositions as $numberPosition) {
            $initialIndexOfNumber = $numberPosition[1];
            $finalIndexOfNumber = $initialIndexOfNumber + strlen($numberPosition[0]);
            if ($position >= $initialIndexOfNumber && $position <= $finalIndexOfNumber) {
                return [$numberPosition[1], $numberPosition[0]];
            }
        }
    }

    private function filterValidGears(array $supposedGears): array {
        return array_filter($supposedGears, function($gear) {
            return count($gear) === 2;
        });
    }

    private function calculateGearRatios(array $gears): int{
        $sum = 0;
        foreach ($gears as $gear) {
            $sum += array_product($gear);
        }
        return $sum;
    }
}