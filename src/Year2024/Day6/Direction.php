<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day6;

enum Direction: string {
    case UP = '^';
    case LEFT = '<';
    case DOWN = 'v';
    case RIGHT = '>';

    public static function getDirection(string $direction): Direction {
        switch ($direction) {
            case '^':
                return self::UP;
            case 'v':
                return self::DOWN;
            case '<':
                return self::LEFT;
            case '>':
                return self::RIGHT;
        }
    }

    public static function turnRight(Direction $currentPosition): Direction {
        return match ($currentPosition) {
            self::UP => self::RIGHT,
            self::RIGHT => self::DOWN,
            self::DOWN => self::LEFT,
            self::LEFT => self::UP,
        };
    }
}
