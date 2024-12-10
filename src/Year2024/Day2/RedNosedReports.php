<?php

declare(strict_types=1);

namespace AdventOfCode\Year2024\Day2;

class RedNosedReports {

    private array $reports = [];

    public function __construct(private readonly string $input) {
        $this->reports = RedNosedReportsInputResolver::convertToMatrix($this->input);
    }

    /** Part 1 */
    public function calculateSafeReports(): int {
        $safeReports = 0;
        foreach ($this->reports as $report) {
            if ($this->isSafeReport($report)) {
                $safeReports += 1;
            }
        }
        return $safeReports;
    }

    private function isSafeReport(array $report): bool {
        if ($this->isOrderedReport($report)) {
            for ($i = 0; $i < count($report) - 1; $i++) {
                $currentLevel = intval($report[$i]);
                $nextLevel = intval($report[$i + 1]);
                if (!$this->isSafeDistanceLevel($currentLevel, $nextLevel)) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    private function isOrderedReport(array $report): bool {
        $sortedReport = $report;
        sort($sortedReport);
        return $report === $sortedReport || array_reverse($sortedReport) === $report;
    }

    private function isSafeDistanceLevel(int $level, int $levelToCompare): bool {
        $distance = abs($level - $levelToCompare);
        return $distance >= 1 && $distance <= 3;
    }

    /** Part 2 */
    public function calculateSafeReportsWithDampener(): int {
        $safeReports = 0;
        foreach ($this->reports as $report) {
            if ($this->isSafeReport($report)) {
                $safeReports ++;
            } elseif ($this->isSafeReportWithDampener($report)) {
                $safeReports ++;
            }
        }
        return $safeReports;
    }

    private function isSafeReportWithDampener(array $report): bool {
        for ($i = 0; $i < count($report); $i++) {
            $reportToValidate = $report;
            unset($reportToValidate[$i]);
            $reportToValidate = array_values($reportToValidate);
            if ($this->isSafeReport($reportToValidate)) {
                return true;
            }
        }
        return false;
    }
}