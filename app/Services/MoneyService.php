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
}
