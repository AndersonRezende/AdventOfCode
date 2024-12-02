<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day1;

class HistorianHysteria {

    private array $locationId;
    public function __construct(private readonly string $input) {
        $this->locationId = HistorianHysteriaInputResolver::processLists($this->input);
    }

    /** Part 1 */
    public function sumDistanceBetweenPairs(): int {
        $this->sortLocationIdLists();
        $sum = 0;
        for ($i = 0; $i < count($this->locationId[0]); $i++) {
            $sum += abs($this->locationId[0][$i] - $this->locationId[1][$i]);
        }
        return $sum;
    }

    private function sortLocationIdLists(): void {
        sort($this->locationId[0]);
        sort($this->locationId[1]);
    }


}