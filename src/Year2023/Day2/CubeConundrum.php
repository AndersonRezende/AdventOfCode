<?php

declare(strict_types = 1);

namespace AdventOfCode\Year2023\Day2;

class CubeConundrum {

    private const string GAME_TEXT_PATTERN = '/Game \d: /';
    private const string QUANTITY_COLOR_PATTERN = '/(\d+)\ (\w+)/';

    /** Part 1 of the challenge */
    public function sumValidGameIds(array $gameRecordList, array $cubeColorsNumbersRequirements): int {
        $sum = 0;
        for ($i = 0; $i < count($gameRecordList); $i++) {
            if ($this->checkIfGameIsValid($gameRecordList[$i], $cubeColorsNumbersRequirements)) {
                $sum += $i + 1;
            }
        }
        return $sum;
    }

    public function checkIfGameIsValid(string $gameRecord, array $cubeColorsNumbersRequirements): bool {
        $gameString = $this->removeGameTextStringOfInput($gameRecord);
        foreach ($cubeColorsNumbersRequirements as $color => $quantity) {
            $colorOccurrenceList = $this->getListOfColorOccurrences($gameString, $color);
            if (!$this->isColorOccurrenceQuantityValid($colorOccurrenceList, $color, $quantity)) {
                return false;
            }
        }
        return true;
    }

    private function removeGameTextStringOfInput(string $input): string {
        return preg_replace(self::GAME_TEXT_PATTERN, '', $input);
    }

    private function getListOfColorOccurrences(string $gameString, string $colorNeeded): array {
        preg_match_all("/\d+ $colorNeeded/", $gameString, $matches);
        return $matches[0];
    }

    private function isColorOccurrenceQuantityValid(array $colorOccurrenceList, string $color, int $quantity): bool {
        foreach ($colorOccurrenceList as $colorOccurrence) {
            if ($quantity < str_replace(" $color", '', $colorOccurrence)) {
                return false;
            }
        }
        return true;
    }


    /** Part 2 of the challenge */
    public function sumOfGamePowerList(array $gameRecordList): int {
        $powerSum = 0;
        foreach ($gameRecordList as $gameRecord) {
            $powerSum += $this->sumOfGamePower($gameRecord);
        }
        return $powerSum;
    }

    private function sumOfGamePower(string $gameRecord): int {
        $powerSum = 0;
        $minimumValidArray = $this->minimumColorQuantityNecessaryToBeValid($gameRecord);
        $powerSum += array_reduce($minimumValidArray, function ($carry, $item) {
            return $carry * $item;
        }, 1);
        return $powerSum;
    }

    public function minimumColorQuantityNecessaryToBeValid(string $gameRecord): array {
        $colorQuantityMap = [];
        $matchSize = preg_match_all(self::QUANTITY_COLOR_PATTERN, $gameRecord, $matches);
        $quantities = $matches[1];
        $colors = $matches[2];
        for ($index = 0; $index < $matchSize; $index++) {
            $colorQuantityMap[$colors[$index]] = $this->quantityToBeFilled(
                $colorQuantityMap,
                $colors[$index],
                $quantities[$index]
            );
        }
        return $colorQuantityMap;
    }

    private function quantityToBeFilled(array $colorQuantityMap, string $color, string $quantity): int {
        if (array_key_exists($color, $colorQuantityMap)) {
            $result = max($colorQuantityMap[$color], $quantity);
            return intval($result);
        }
        return intval($quantity);
    }
}