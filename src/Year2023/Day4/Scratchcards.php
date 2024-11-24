<?php

declare(strict_types = 1);

namespace AdventOfCode\Year2023\Day4;

class Scratchcards {

    private readonly array $scratchcards;

    public function __construct(string $scratchcardInputString) {
        $this->scratchcards = ScratchcardsInputResolver::convertStringToArray($scratchcardInputString);
    }

    public function calculateTotalPoints(): int {
        $sum = 0;
        foreach ($this->scratchcards as $scratchcard) {
            $sum += $this->calculateGamePoints($scratchcard);
        }
        return $sum;
    }

    private function calculateGamePoints(array $scratchcardLine): int {
        $intersectedNumbers = array_intersect($scratchcardLine[0], $scratchcardLine[1]);
        $exponent = count($intersectedNumbers) - 1;
        return $exponent < 0 ? 0 : pow(2, $exponent);
    }

}