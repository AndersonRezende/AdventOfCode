<?php

namespace AdventOfCode\Year2023\Day1;

class Trebuchet {

    private const string ONLY_DIGITS_AND_SPELLED_NUMBERS_PATTERN =
        '/(?=(1|2|3|4|5|6|7|8|9|one|two|three|four|five|six|seven|eight|nine))/i';

    private const array STRING_NUMBER_MAP = [
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => 5,
        'six' => 6,
        'seven' => 7,
        'eight' => 8,
        'nine' => 9
    ];

    public function decodeCalibrationValue(string $encodedText): int {
        preg_match_all(self::ONLY_DIGITS_AND_SPELLED_NUMBERS_PATTERN, $encodedText, $matches);
        $decodedNumbers = $matches[1];
        $firstNumber = $decodedNumbers[0];
        $lastNumber = $decodedNumbers[sizeof($decodedNumbers) - 1];
        if (array_key_exists($firstNumber, self::STRING_NUMBER_MAP)) {
            $firstNumber = self::STRING_NUMBER_MAP[$firstNumber];
        }
        if (array_key_exists($lastNumber, self::STRING_NUMBER_MAP)) {
            $lastNumber = self::STRING_NUMBER_MAP[$lastNumber];
        }
        return intval($firstNumber . $lastNumber);
    }

    public function sumCalibrationValues(array $encodedTextList): int {
        $sum = 0;
        foreach ($encodedTextList as $encodedText) {
            $sum += $this->decodeCalibrationValue($encodedText);
        }
        return $sum;
    }
}