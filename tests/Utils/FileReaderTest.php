<?php

namespace AdventOfCode\Tests\Utils;

use AdventOfCode\Utils\FileNotExistException;
use AdventOfCode\Utils\FileReader;
use Iterator;
use PHPUnit\Framework\TestCase;

class FileReaderTest extends TestCase {

    public function test_WhenAExistingFileIsRead_ShouldReturnFileContent(): void {
        $fileContent = 'Temp file content';
        $tempFile = tempnam(sys_get_temp_dir(), 'temp_test_file');
        file_put_contents($tempFile, $fileContent);

        $content = FileReader::read($tempFile);

        $this->assertEquals($fileContent, $content);
        unlink($tempFile);
    }

    public function test_WhenANonExistingFileIsRead_ShouldThrowException(): void {
        $this->expectException(FileNotExistException::class);
        $this->expectExceptionMessage('File does not exist');

        FileReader::read('temp_test_file');
    }
}