<?php

namespace AdventOfCode\Utils;

class FileReader {
    public static function read($filePath): false|string {
        if (!file_exists($filePath)) {
            throw new FileNotExistException();
        }
        return file_get_contents($filePath);
    }
}