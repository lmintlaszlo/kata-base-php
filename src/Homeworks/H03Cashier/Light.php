<?php

namespace Kata\Homeworks\H03Cashier;


class Light extends Product
{
    protected $name       = 'Light';
    protected $price      = 15;
    protected $amountUnit = self::AMOUNT_YEAR;
    
    public function __construct($amount = 1)
    {
        parent::__construct($amount, new DiscountNone());
    }

} 