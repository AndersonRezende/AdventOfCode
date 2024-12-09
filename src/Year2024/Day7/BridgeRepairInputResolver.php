<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day7;

class BridgeRepairInputResolver {

    private const string TEST_VALUE_PATTERN = '/(\d+)(?=:)/';
    private const string ONLY_NUMBERS_PATTERN = '/\d+/';

    public static function extractValues(string $input): array {
        $operations = explode(PHP_EOL, $input);
        return array_map(function ($operatorLine) {
            $testValue = self::extractTestValue($operatorLine);
            $operators = self::extractOperators($operatorLine);
            return [$testValue, $operators];
        }, $operations);
    }

    private static function extractTestValue(string $operationLine): int {
        preg_match_all(self::TEST_VALUE_PATTERN, $operationLine, $matchedTestValue);
        return intval($matchedTestValue[0][0]);
    }

    private static function extractOperators(string $operatorLine): array {
        $operatorsString = preg_replace(self::TEST_VALUE_PATTERN, '', $operatorLine);
        preg_match_all(self::ONLY_NUMBERS_PATTERN, $operatorsString, $operators);
        return array_map('intval', $operators[0]);
    }
}