<?php declare(strict_types=1);

namespace App\Service;

class ParityChecker
{
    public function isEven(int $number): bool
    {
        if ($number % 2 == 0) {
            return true;
        }

        return false;
    }

    public function isOdd($number): bool
    {
        if ($number % 2 == 0) {
            return false;
        }

        return true;
    }
}
