<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day3;

class MullItOver {

    private const string ONLY_VALID_MULTIPLICATIONS_PATTERN = '/mul\(\d{1,3},\d{1,3}\)/';
    private const string ONLY_NUMBERS_PATTERN = '/\d+/';
    private const string VALID_INSTRUCTIONS_PATTERN = '/(do\(\))|(don\'t\(\))|(mul\(\d{1,3}\,\d{1,3}\))/';
    private const string IGNORE_INSTRUCTION_PATTERN = '/don\'t\(\)/';

    public function __construct(private readonly string $inputMemory) {}

    /** Part 1 */
    public function calculate(): int {
        $multiplicationInstructions = $this->getMultiplicationInstructions();
        $sum = 0;
        foreach ($multiplicationInstructions as $instruction) {
            $sum += $this->multiply($instruction[0]);
        }
        return $sum;
    }

    private function multiply(string $multiplyInstruction): int {
        preg_match_all(self::ONLY_NUMBERS_PATTERN, $multiplyInstruction, $numbers);
        return intval($numbers[0][0]) * intval($numbers[0][1]);
    }

    private function getMultiplicationInstructions(int $flags = 0): array {
        preg_match_all(self::ONLY_VALID_MULTIPLICATIONS_PATTERN, $this->inputMemory, $matches, PREG_OFFSET_CAPTURE);
        return $matches[0];
    }

    /** Part 2 */
    public function calculateWithNewInstructions(): int {
        preg_match_all(self::VALID_INSTRUCTIONS_PATTERN, $this->inputMemory, $matches, PREG_OFFSET_CAPTURE);
        $instructions = $matches[0];
        $ignoreInstructionFlag = false;
        $sum = 0;
        foreach ($instructions as $instruction) {
            if ($this->isMultiplyInstruction($instruction[0])) {
                if (!$ignoreInstructionFlag) {
                    $sum += $this->multiply($instruction[0]);
                }
            } else {
                $ignoreInstructionFlag = $this->shouldIgnoreInstructions($instruction[0]);
            }
        }
        return $sum;
    }

    private function isMultiplyInstruction(string $instruction): bool {
        return preg_match(self::ONLY_VALID_MULTIPLICATIONS_PATTERN, $instruction) === 1;
    }

    private function shouldIgnoreInstructions(string $instruction): bool {
        return preg_match(self::IGNORE_INSTRUCTION_PATTERN, $instruction) === 1;
    }
}