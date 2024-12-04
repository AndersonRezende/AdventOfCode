<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day3;

class MullItOver {

    private const string ONLY_VALID_MULTIPLICATIONS_PATTERN = '/mul\(\d{1,3}\,\d{1,3}\)/';
    private const string ONLY_NUMBERS_PATTERN = '/\d+/';

    public function __construct(private readonly string $inputMemory) {}

    /** Part 1 */
    public function calculate(): int {
        preg_match_all(self::ONLY_VALID_MULTIPLICATIONS_PATTERN, $this->inputMemory, $matches);
        $sum = 0;
        foreach ($matches[0] as $match) {
            preg_match_all(self::ONLY_NUMBERS_PATTERN, $match, $numbers);
            $sum += intval($numbers[0][0]) * intval($numbers[0][1]);
        }
        return $sum;
    }


}