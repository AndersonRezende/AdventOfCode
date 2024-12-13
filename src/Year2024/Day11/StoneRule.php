<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day11;

class StoneRule {

    public static function applyRule(int $stone): array {
        $stoneString = strval($stone);
        if (strlen($stoneString) === 1 && intval($stoneString) === 0) {
            return self::rule1();
        }
        if (strlen($stoneString) % 2 === 0 ) {
            return self::rule2($stoneString);
        }
        return self::rule3($stone);
    }

    private static function rule1(): array {
        return [1];
    }

    private static function rule2(string $stone): array {
        $length = strlen($stone);
        $leftPart = substr($stone, 0, $length / 2);
        $rightPart = substr($stone, $length / 2);
        return [intval($leftPart),  intval($rightPart)];
    }

    private static function rule3(int $stone): array {
        return [$stone * 2024];
    }
}
