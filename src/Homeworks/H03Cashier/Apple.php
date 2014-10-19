<?php

namespace Kata\Homeworks\H03Cashier;


class Apple extends Product
{    
    protected $name       = 'Apple';
    protected $price      = 32;
    protected $amountUnit = self::AMOUNT_KG;
    
    public function __construct($amount = 1)
    {
        parent::__construct($amount, new DiscountPrice(5, 25));
    }

} 