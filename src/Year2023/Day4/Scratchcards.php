<?php

declare(strict_types = 1);

namespace AdventOfCode\Year2023\Day4;

class Scratchcards {

    private readonly array $scratchcards;

    public function __construct(string $scratchcardInputString) {
        $this->scratchcards = ScratchcardsInputResolver::convertStringToArray($scratchcardInputString);
    }

    /** Part 1 */
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

    /** Part 2 */
    public function calculateTotalScratchcardsYouEndUpWith(): int {
        $scratchcardCopies = array_fill(0, count($this->scratchcards), 0);
        foreach ($this->scratchcards as $key => $scratchcard) {
            $scratchcardCopies[$key] += 1;
            $nextScratchcardsCopiesGainedOffset = $this->calculateNextScratchcardsCopies($scratchcard);
            $scratchcardCopies = $this->updateValues(
                $scratchcardCopies, $key + 1, $nextScratchcardsCopiesGainedOffset, $scratchcardCopies[$key]
            );
        }
        return array_sum($scratchcardCopies);
    }

    private function calculateNextScratchcardsCopies(array $scratchcardLine): int {
        $intersectedNumbers = array_intersect($scratchcardLine[0], $scratchcardLine[1]);
        return count($intersectedNumbers);
    }

    private function updateValues(
        array $cardsQuantity, int $startIndex, int $offset, int $lastScratchcardCopies
    ): array {
        for ($i = $startIndex; $i < $startIndex + $offset; $i++) {
            $cardsQuantity[$i] += $lastScratchcardCopies;
        }
        return $cardsQuantity;
    }
}