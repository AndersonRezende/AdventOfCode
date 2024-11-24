<?php

declare(strict_types=1);

namespace AdventOfCode\Year2023\Day4;

class ScratchcardsInputResolver {

    private const string ONLY_NUMBERS_PATTERN = '/\d+/';
    private const string CARD_TEXT_PATTERN = '/Card\s*\d*\:/';
    private const string WINNING_NUMBERS_AND_NUMBERS_YOU_HAVE_DIVISOR_PATTERN = '/\|/';

    public static function convertStringToArray(string $scratchcardString): array {
        $scratchcards = self::splitScratchcardsStringIntoScratchcardsArray($scratchcardString);
        for ($i = 0; $i < count($scratchcards); $i++) {
            $scratchcards[$i] = self::splitScratchcardIntoWinningNumbersAndNumbersYouHave($scratchcards[$i]);
        }
        return $scratchcards;
    }

    private static function splitScratchcardsStringIntoScratchcardsArray(string $scratchcards): array {
        return explode("\n", $scratchcards);
    }

    private static function splitScratchcardIntoWinningNumbersAndNumbersYouHave(string $scratchcard): array {
        $splitScratchcard = preg_replace(self::CARD_TEXT_PATTERN, '', $scratchcard);
        $splitScratchcard = preg_split(self::WINNING_NUMBERS_AND_NUMBERS_YOU_HAVE_DIVISOR_PATTERN, $splitScratchcard);
        preg_match_all(self::ONLY_NUMBERS_PATTERN, $splitScratchcard[0], $winningNumbersMatches);
        preg_match_all(self::ONLY_NUMBERS_PATTERN, $splitScratchcard[1], $numbersYouHaveMatches);
        return [$winningNumbersMatches[0], $numbersYouHaveMatches[0]];
    }
}