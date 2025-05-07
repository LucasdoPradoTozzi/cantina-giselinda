<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case PIX = 'pix';
    case CASH = 'cash';
    case CREDIT_CARD = 'credit_card';
    case DEBIT_CARD = 'debit_card';

    public function label(): string
    {
        return match ($this) {
            self::PIX => 'Pix',
            self::CASH => 'Dinheiro',
            self::CREDIT_CARD => 'Cartão de Crédito',
            self::DEBIT_CARD => 'Cartão de Débito',
        };
    }
}
