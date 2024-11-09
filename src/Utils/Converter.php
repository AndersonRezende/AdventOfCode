<?php

namespace AdventOfCode\Utils;

class Converter {
    public static function stringToArray(string $input): array {
        $arrayLines = explode(PHP_EOL, $input);
        return array_map('str_split', $arrayLines);
    }

}