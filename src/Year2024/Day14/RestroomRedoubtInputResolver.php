<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day14;

class RestroomRedoubtInputResolver {

    private const string ONLY_NUMBERS_PATTERN = '/-*\d+/';

    public static function extractRobots(string $input): array {
        $robots = [];
        foreach (explode(PHP_EOL, $input) as $line) {
            $robots[] = self::extractRobot($line);
        }
        return $robots;
    }

    private static function extractRobot(string $lineInput): array {
        preg_match_all(self::ONLY_NUMBERS_PATTERN, $lineInput, $matches);
        $position = [$matches[0][0], $matches[0][1]];
        $valocity = [$matches[0][2], $matches[0][3]];
        return [$position, $valocity];
    }

}