<?php

declare(strict_types=1);

namespace AdventOfCode\Tests\Year2024\Day9;

use AdventOfCode\Year2024\Day9\DiskFragmenter;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class DiskFragmenterTest extends TestCase {

    public static function getDiskMap(): string {
        return '2333133121414131402';
    }

    public static function dataProviderCheckSum(): Iterator {
        yield 'Checksum 1' => [self::getDiskMap(), 1928];
    }

    #[DataProvider('dataProviderCheckSum')]
    public function test_WhenAnInputStringContainingADiskMapIsGiven_ShouldReturnTheChecksumFileSystem(
        string $input,
        int $expected
    ): void {
        $diskFragmenter = new DiskFragmenter($input);
        $checkSum = $diskFragmenter->filesystemChecksumCount();

        $this->assertEquals($expected, $checkSum);
    }

    public static function dataProviderCheckSumWithoutFragmentation(): Iterator {
        yield 'Checksum 1' => [self::getDiskMap(), 2858];
    }

    #[DataProvider('dataProviderCheckSumWithoutFragmentation')]
    public function test_WhenAnInputStringContainingADiskMapIsGiven_ShouldReturnTheChecksumFileSystemWithoutFragmentation(
        string $input,
        int $expected
    ): void {
        $diskFragmenter = new DiskFragmenter($input);
        $checkSum = $diskFragmenter->filesystemChecksumWithoutFragmentationCount();

        $this->assertEquals($expected, $checkSum);
    }
}