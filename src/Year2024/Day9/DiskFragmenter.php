<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day9;

class DiskFragmenter {

    private const string EMPTY = '.';

    public function __construct(private readonly string $input) {}

    /** Part 1 */
    public function filesystemChecksumCount(): int {
        $idNumberMap = $this->generateIdNumberMap();
        $otimizedIdNumberMap = $this->moveIdBlocksFileBlocksFromEndToBeginning($idNumberMap);
        return $this->calculateChecksum($otimizedIdNumberMap);
    }

    private function generateIdNumberMap(): array {
        $idNumberMap = [];
        $idValue = 0;
        foreach (str_split($this->input) as $key => $timesToRepeat) {
            if ($key % 2 === 0) {
                $idNumberMap = array_merge($idNumberMap, $this->generateIdBlocks($idValue, intval($timesToRepeat)));
                $idValue++;
            } else {
                $idNumberMap = array_merge($idNumberMap, $this->generateIdBlocks(self::EMPTY, intval($timesToRepeat)));
            }
        }
        return $idNumberMap;
    }

    private function generateIdBlocks(string|int $id, int $times): array {
        return array_fill(0, $times, $id);
    }

    private function moveIdBlocksFileBlocksFromEndToBeginning(array $fileBlocks): array {
        $nextFreePosition = $this->findNextEmptyPosition($fileBlocks);
        $lastIdPosition = $this->findLastIdPosition($fileBlocks, count($fileBlocks) - 1);
        while ($nextFreePosition < $lastIdPosition) {
            $fileBlocks = $this->swapElements($fileBlocks, $nextFreePosition, $lastIdPosition);
            $nextFreePosition = $this->findNextEmptyPosition($fileBlocks, $nextFreePosition);
            $lastIdPosition = $this->findLastIdPosition($fileBlocks, $lastIdPosition);
        }
        return $fileBlocks;
    }

    private function findNextEmptyPosition(array $fileBlocks, int $currentPosition = 0): int {
        $emptyPosition = $currentPosition;
        while($fileBlocks[$emptyPosition] !== self::EMPTY) {
            $emptyPosition++;
        }
        return $emptyPosition;
    }

    private function findLastIdPosition(array $fileBlocks, int $currentPosition): int {
        $lastIdPosition = $currentPosition;
        while($fileBlocks[$lastIdPosition] === self::EMPTY) {
            $lastIdPosition--;
        }
        return $lastIdPosition;
    }

    private function swapElements(array $fileBlocks, int $freePosition, int $idPosition): array {
        $freePositionTemp = $fileBlocks[$freePosition];
        $fileBlocks[$freePosition] = $fileBlocks[$idPosition];
        $fileBlocks[$idPosition] = $freePositionTemp;
        return $fileBlocks;
    }

    private function calculateChecksum(array $otimizedIdNumberMap): int {
        $checksum = 0;
        foreach ($otimizedIdNumberMap as $position => $idNumber) {
            $checksum += intval($idNumber) * intval($position);
        }
        return $checksum;
    }
}