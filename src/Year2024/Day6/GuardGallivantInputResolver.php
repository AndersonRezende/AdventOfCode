<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day6;

class GuardGallivantInputResolver {

    private const string PLAYER_PATTERN = '/[^#.\r]+/';
    private const array NOT_GUARD_ELEMENTS = ['.', '#'];

    public static function convertToArrayMap(string $stringMap): array {
        $arrayMap = explode(PHP_EOL, $stringMap);
        return array_map(function (string $line) {
            return str_split(trim($line));
        }, $arrayMap);
    }

    public static function getGuardPosition(array $arrayMap): array {
        for ($row = 0; $row < count($arrayMap); $row++) {
            for ($column = 0; $column < count($arrayMap); $column++) {
                if (!in_array($arrayMap[$row][$column], self::NOT_GUARD_ELEMENTS)) {
                    return [$row, $column];
                }
            }
        }
        return [0, 0];
    }
}