<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day14;

class RestroomRedoubt {

    private array $robots = [];
    private int $middleWidith;
    private int $middleHeight;

    public function __construct(
        private readonly string $input, private readonly int $width, private readonly int $height
    ) {
        $this->robots = RestroomRedoubtInputResolver::extractRobots($this->input);
        $this->middleWidith = intdiv($this->width, 2);
        $this->middleHeight = intdiv($this->height, 2);
    }

    /** Part 1 */

    public function calculateSecurityFactorAfterTime(int $time): int {
        $robotsByQuadrant = [0, 0, 0, 0];
        foreach ($this->robots as $robot) {
            $robotFinalPosition = $this->getRobotFinalPositionAfterTime($robot, $time);

            $quadrant = $this->getQuadrant($robotFinalPosition[0], $robotFinalPosition[1]);
            if ($quadrant != -1) {
                $robotsByQuadrant[$quadrant] += 1;
            }
        }

        $robotsByQuadrant = array_filter($robotsByQuadrant, function($valor) {
            return $valor != 0;
        });

        return array_reduce($robotsByQuadrant, function($carry, $quadrant) {
            return $carry * $quadrant;
        }, 1);
    }

    private function getRobotFinalPositionAfterTime(array $robot, int $time): array {
        $horizontalPosition = intval($robot[0][0]);
        $horizontalVelocity = intval($robot[1][0]);
        $finalXPosition = $this->getFinalPositionAfterTime($horizontalPosition, $horizontalVelocity, $this->width, $time);

        $verticalPosition = intval($robot[0][1]);
        $verticalVelocity = intval($robot[1][1]);
        $finalYPosition = $this->getFinalPositionAfterTime($verticalPosition, $verticalVelocity, $this->height, $time);

        return [$finalXPosition, $finalYPosition];
    }

    private function getFinalPositionAfterTime(int $initialPosition, int $velocity, int $maxPosition, int $time): int {
        $positionsToMove = $velocity * $time + $initialPosition;
        return (($positionsToMove % $maxPosition) + $maxPosition) % $maxPosition;
    }

    private function getQuadrant(int $horizontalPosition, int $verticalPosition): int {
        if ($horizontalPosition < $this->middleWidith && $verticalPosition < $this->middleHeight) {
            return 0;
        } elseif ($horizontalPosition > $this->middleWidith && $verticalPosition < $this->middleHeight) {
            return 1;
        } elseif ($horizontalPosition < $this->middleWidith && $verticalPosition > $this->middleHeight) {
            return 2;
        } elseif ($horizontalPosition > $this->middleWidith && $verticalPosition > $this->middleHeight) {
            return 3;
        }
        return -1;
    }

    /** Part 2 */

    public function getChristmasTree(int $time): void {
        while ($time > 0) {
            $map = array_fill(0, $this->height, array_fill(0, $this->width, " "));
            foreach ($this->robots as $robot) {
                [$horizontalPosition, $verticalPosition] = $this->getRobotFinalPositionAfterTime($robot, $time);
                $map[$horizontalPosition][$verticalPosition] = '#';
            }
            $this->saveCurrentMatrixState($map, $time);
            $time--;
        }
    }

    private function saveCurrentMatrixState(array $map, int $time): void {
        $matrix = "$time....................." . PHP_EOL;
        for ($i = 0; $i < count($map); $i++) {
            for ($j = 0; $j < count($map[$i]); $j++) {
                $matrix .= $map[$i][$j];
            }
            $matrix .= PHP_EOL . PHP_EOL;
        }

        $matrix .= str_repeat('-', $this->width) . PHP_EOL;
        $file = fopen('debug.txt', 'a');
        fwrite($file, $matrix);
        fclose($file);
    }
}