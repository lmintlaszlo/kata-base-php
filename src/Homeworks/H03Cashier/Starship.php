<?php

namespace Kata\Homeworks\H03Cashier;


class Starship extends Product
{
    protected $name                 = 'Starship';
    protected $price                = 999.99;
    protected $amountUnit           = self::AMOUNT_PIECE;
    
    public function __construct($amount = 1)
    {
        parent::__construct($amount, new DiscountPiece(2, 1));
    }

} 