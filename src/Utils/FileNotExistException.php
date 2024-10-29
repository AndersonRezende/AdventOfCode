<?php

namespace AdventOfCode\Utils;

use Exception;

class FileNotExistException extends Exception {

    public function __construct() {
        parent::__construct('File does not exist');
    }
}