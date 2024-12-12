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
            $fileBlocks = $this->swapElement($fileBlocks, $nextFreePosition, $lastIdPosition);
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

    private function swapElement(array $fileBlocks, int $freePosition, int $idPosition): array {
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

    /** Part 2 */
    public function filesystemChecksumWithoutFragmentationCount(): int {
        $idNumberMap = $this->generateIdNumberMap();
        $otimizedIdNumberMap = $this->moveIdBlocksFileBlocksFromEndToBeginningWithoutFragmentation($idNumberMap);
        return $this->calculateChecksum($otimizedIdNumberMap);
    }

    private function moveIdBlocksFileBlocksFromEndToBeginningWithoutFragmentation(array $fileBlocks): array {
        $lastId = $this->getLastId($fileBlocks);

        [$idToRelocate, $startIndexToRelocate, $sizeToRelocate] = $this->getIdBlockSize($fileBlocks, $lastId);
        $startFreeIdToRelocate = $this->findFirstFreePositions($fileBlocks, $sizeToRelocate, count($fileBlocks) - 1);

        while ($lastId > 0) {
            if ($startFreeIdToRelocate != -1) {
                $fileBlocks = $this->swapElements($fileBlocks, $startFreeIdToRelocate, $startIndexToRelocate, $sizeToRelocate);
            } else {
                $startIndexToRelocate -= 1;
            }
            $lastId--;
            [$idToRelocate, $startIndexToRelocate, $sizeToRelocate] = $this->getIdBlockSize($fileBlocks, $lastId);
            $startFreeIdToRelocate = $this->findFirstFreePositions($fileBlocks, $sizeToRelocate, $startIndexToRelocate);
        }
        return $fileBlocks;
    }

    private function getIdBlockSize(array $fileBlocks, int $idWanted): array {
        $lastPosition = count($fileBlocks) - 1;
        while ($lastPosition > 0 && $fileBlocks[$lastPosition] !== $idWanted) {
            $lastPosition--;
        }
        if ($lastPosition < 0) {
            return [-1, -1, -1];
        }
        $startPosition = $lastPosition;
        while ($startPosition > 0 && $fileBlocks[$startPosition] === $idWanted) {
            $startPosition--;
        }
        $startPosition++;
        return [$idWanted, $startPosition, $lastPosition - $startPosition + 1];
    }

    private function findFirstFreePositions(array $fileBlocks, int $sizeToRelocate, int $lastIndexToSearch): int {
        $freeCount = 0;
        foreach ($fileBlocks as $position => $fileBlock) {
            if ($fileBlock === self::EMPTY) {
                $freeCount++;
            } else {
                $freeCount = 0;
            }
            if ($freeCount >= $sizeToRelocate) {
                return $position - $freeCount + 1;
            }
            if ($position > $lastIndexToSearch) {
                return -1;
            }
        }
        return -1;
    }

    private function swapElements(
        array $fileBlocks, int $startFreeIdToRelocate, int $startIndexToRelocate, int $sizeToRelocate
    ): array {
        $timesReplaced = 0;
        while ($timesReplaced < $sizeToRelocate) {
            $fileBlocks = $this->swapElement($fileBlocks, $startFreeIdToRelocate + $timesReplaced, $startIndexToRelocate + $timesReplaced);
            $timesReplaced++;
        }
        return $fileBlocks;
    }

    private function getLastId(array $fileBlocks): int {
        $id = count($fileBlocks) - 1;
        while ($id > 0 && $fileBlocks[$id] === self::EMPTY) {
            $id--;
        }
        return $fileBlocks[$id];
    }
}