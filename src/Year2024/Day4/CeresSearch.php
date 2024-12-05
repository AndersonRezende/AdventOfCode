<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day4;

class CeresSearch {

    private const string XMAS = 'XMAS';
    private const array DIRECTIONS = [
        [0, 1],
        [1, 0],
        [1, 1],
        [-1, 1],
    ];

    private const array VALID_CORNER_OPTIONS_AROUND_LETTER_A = ['M', 'S'];

    private array $inputMatrix = [];
    private int $matrixColumns;
    private int $matrixRows;

    public function __construct(private string $inputString) {
        $this->inputString = str_replace(' ', '', $this->inputString);
        $this->inputMatrix = array_map('str_split', explode(PHP_EOL, $this->inputString));
        $this->matrixRows = count($this->inputMatrix);
        $this->matrixColumns = count($this->inputMatrix[0]);
    }

    /** Part 1 */
    public function countXmasWords(): int {
        $xmasWordCounter = 0;
        for ($row = 0; $row < count($this->inputMatrix); $row++) {
            for ($column = 0; $column < count($this->inputMatrix[$row]); $column++) {
                $xmasWordCounter += $this->countValidXMASWord($row, $column);
            }
        }
        return $xmasWordCounter;
    }

    private function countValidXMASWord(int $row, int $column): int {
        $counter = 0;
        foreach (self::DIRECTIONS as [$directionRow, $directionColumn]) {
            $counter += $this->checkWord($row, $column, $directionRow, $directionColumn);
        }
        return $counter;
    }

    private function checkWord(int $row, int $column, int $directionRow, int $directionColumn): int {
        $word = '';
        for ($i = 0; $i < 4; $i++) {
            $currentRow = $row + $i * $directionRow;
            $currentCol = $column + $i * $directionColumn;
            if ($currentRow < 0 || $currentRow >= $this->matrixRows || $currentCol < 0 || $currentCol >= $this->matrixColumns) {
                return 0;
            }
            $word .= $this->inputMatrix[$currentRow][$currentCol];
        }
        return $this->isValidXMASWord($word) ? 1 : 0;
    }

    private function isValidXMASWord(string $word): bool {
        return $word === self::XMAS || strrev($word) === self::XMAS;
    }


    /** Part 2 */
    public function countMASWordsInXFormat(): int {
        $masWordCounter = 0;
        for ($row = 0; $row < count($this->inputMatrix); $row++) {
            for ($column = 0; $column < count($this->inputMatrix[$row]); $column++) {
                if ($this->inputMatrix[$row][$column] === 'A' && $this->isValidMASWordInXFormat($row, $column)) {
                    $masWordCounter++;
                }
            }
        }
        return $masWordCounter;
    }


    private function isValidMASWordInXFormat(int $row, int $column): bool {
        if ($row == 0 || $row == $this->matrixRows - 1 || $column == 0 || $column == $this->matrixColumns - 1) {
            return false;
        }
        [$topLeft, $topRight, $bottomLeft, $bottomRight] = $this->getCornersLettersAroundCenterA($row, $column);
        if (count(array_intersect([$topLeft, $topRight, $bottomLeft, $bottomRight], self::VALID_CORNER_OPTIONS_AROUND_LETTER_A)) != 4) {
            return false;
        }

        return $topLeft == $topRight && $bottomLeft == $bottomRight && $topLeft != $bottomLeft ||
            $topLeft == $bottomLeft && $topRight == $bottomRight && $topLeft != $topRight;
    }

    private function getCornersLettersAroundCenterA(int $row, int $column): array {
        return [
            $this->inputMatrix[$row - 1][$column - 1],
            $this->inputMatrix[$row - 1][$column + 1],
            $this->inputMatrix[$row + 1][$column - 1],
            $this->inputMatrix[$row + 1][$column + 1],
        ];
    }
}