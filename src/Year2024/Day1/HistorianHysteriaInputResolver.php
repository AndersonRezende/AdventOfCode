<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day1;

class HistorianHysteriaInputResolver {

    private const string ONLY_NUMBERS_PATTERN = '/\d+/';

    public static function processLists(string $input): array {
        preg_match_all(self::ONLY_NUMBERS_PATTERN, $input, $matches);
        $output = [];
        foreach ($matches[0] as $key => $match) {
            $listToFill = $key % 2 === 0 ? 0 : 1;
            $output[$listToFill][] = intval($match);
        }
        return $output;
    }
}