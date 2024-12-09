<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day7;

class BridgeRepair {

    private const array OPERATORS = ['+', '*', '|'];
    private array $operationsMap = [];

    public function __construct(private readonly string $input) {
        $this->operationsMap = BridgeRepairInputResolver::extractValues($this->input);
    }

    public function sumTestValuesOfPossiblesEquations(): int {
        $sum = 0;
        foreach ($this->operationsMap as $operation) {
            if ($this->isEquationPossible($operation)) {
                $sum += $operation[0];
            }
        }
        return $sum;
    }

    private function isEquationPossible(array $operation): bool {
        $mathOperationsQuantity = count($operation[1]) - 1;
        $operationsPermutation = $this->generateOperationsPermutation($mathOperationsQuantity);
        return $this->isPossibleToObtainResult($operation[0], $operation[1], $operationsPermutation);
    }

    private function generateOperationsPermutation(int $length): array {
        if ($length === 1) {
            return array_map(fn($operator) => [$operator], self::OPERATORS);
        }
        $permutations = [];
        foreach (self::OPERATORS as $operator) {
            $subPermutations = $this->generateOperationsPermutation($length - 1);
            foreach ($subPermutations as $sub) {
                $permutations[] = array_merge([$operator], $sub);
            }
        }
        return $permutations;
    }

    private function isPossibleToObtainResult(int $expectedValue, array $operands, array $permutationOperators): bool {
        foreach ($permutationOperators as $permutationOperator) {
            $value = $operands[0];
            foreach ($permutationOperator as $key => $operator) {
                $value = $this->calculate($value, $operands[$key + 1], $operator);
            }
            if ($value === $expectedValue) {
                return true;
            }
        }
        return false;
    }

    private function calculate(int $firstOperator, int $secondOperator, string $operation): int {
        if ($operation === '+') {
            return $firstOperator + $secondOperator;
        } elseif ($operation === '*') {
            return $firstOperator * $secondOperator;
        }
        return intval("$firstOperator"."$secondOperator");
    }
}