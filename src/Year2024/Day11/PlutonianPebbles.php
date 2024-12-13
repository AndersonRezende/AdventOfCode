<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day11;

class PlutonianPebbles {

    public function calculateHowManyStonesAfterBlinking(string $originalStonesArrangement, int $blinkingTimes): int {
        $stonesArrangement = explode(' ', $originalStonesArrangement);
        return $this->applyRules($stonesArrangement, $blinkingTimes);
    }

    private function applyRules(array $stonesArrangement, int $blinkingTimes): int {
        $countItems = 0;
        foreach ($stonesArrangement as $stone) {
            $countItems += $this->countArrangementStones(intval($stone), $blinkingTimes - 1);
        }
        return $countItems;
    }

    private function countArrangementStones(int $stonesArrangement, int $blinkingTimes): int {
        $currentArrangementStones = StoneRule::applyRule($stonesArrangement);
        if ($blinkingTimes === 0) {
            return count($currentArrangementStones);
        }

        $count = 0;
        foreach ($currentArrangementStones as $stone) {
            $count += $this->countArrangementStones($stone, $blinkingTimes - 1);
        }
        return $count;
    }
}