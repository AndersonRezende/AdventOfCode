<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day2;

class RedNosedReportsInputResolver {

    private const string ONLY_NUMBERS = '/(\d+)+/';

    public static function convertToMatrix(string $input): array {
        $lines = array_filter(explode(PHP_EOL, $input));
        return array_map(function($line) {
            preg_match_all(self::ONLY_NUMBERS, $line, $matches);
            return $matches[0];
        }, $lines);
    }
}