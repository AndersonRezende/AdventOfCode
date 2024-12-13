<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day11;

class StoneRule {

    public static function applyRule(string $stone): string {
        if (strlen($stone) === 1 && intval($stone) === 0) {
            return self::rule1($stone);
        }
        if (strlen($stone) % 2 === 0 ) {
            return self::rule2($stone);
        }
        return self::rule3($stone);
    }

    private static function rule1(string $stone): string {
        return '1 ';
    }

    private static function rule2(string $stone): string {
        $length = strlen($stone);
        $leftPart = substr($stone, 0, $length / 2);
        $rightPart = substr($stone, $length / 2);
        return intval($leftPart) . ' ' . intval($rightPart) . ' ';
    }

    private static function rule3(string $stone): string {
        return strval(intval($stone) * 2024) . ' ';
    }
}
