<?php

namespace App\Services;

use Exception;

class MoneyService
{


    public function convertStringToInteger(string $value): int
    {

        $value = trim($value);
        if (!preg_match('/^\d+(\.\d{1,2})?$/', $value)) {
            throw new Exception("Valor monetário inválido: '{$value}'");
        }

        return (int) bcmul($value, '100', 0);
    }

    public function convertIntegerToString(int $value): string
    {
        return bcdiv((string) $value, '100', 2);
    }

    public function getMultiplicationIntegerValue(int $value1, int $value2): int
    {
        $value = bcdiv((string) $value1, '100', 2);
        $value = bcmul($value, (string) $value2, 2);
        return (int) bcmul($value, '100', 0);
    }

    public function getMultiplicationStringValue(int $value1, int $value2): string
    {
        $value = bcdiv((string) $value1, '100', 2);
        return bcmul($value, (string) $value2, 2);
    }

    public function getAdditionIntegerValue(int $value1, int $value2): int
    {
        $value1 = bcdiv((string) $value1, '100', 2);
        $value2 = bcdiv((string) $value2, '100', 2);
        $additionResult = bcadd($value1, $value2, 2);
        return (int) bcmul($additionResult, '100', 0);
    }
}
