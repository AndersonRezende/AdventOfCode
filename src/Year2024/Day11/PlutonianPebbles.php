<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day11;

class PlutonianPebbles {

    public function calculateHowManyStonesAfterBlinking(string $originalStonesArrangement, int $blinkingTimes): int {
        $stonesArrangement = $originalStonesArrangement;
        for ($i = 1; $i <= $blinkingTimes; $i++) {
            $stonesArrangement = $this->applyRules($stonesArrangement);
        }
        return count(explode(' ', $stonesArrangement));
    }

    private function applyRules(string $stonesArrangement): string {
        $newStoneArrangement = '';
        $stonesArrangementList = explode(' ', $stonesArrangement);
        foreach ($stonesArrangementList as $stone) {
            $newStoneArrangement .= StoneRule::applyRule($stone);
        }
        return trim($newStoneArrangement);
    }
}