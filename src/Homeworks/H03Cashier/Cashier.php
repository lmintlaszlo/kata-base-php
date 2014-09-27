<?php

namespace Kata\Homeworks\H03Cashier;

class Cashier
{

    /**
     * Calculates the price of goods in a basket.
     *
     * @return float
     */
    public function calculate($price, $amount)
    {
        return $price * $amount;
    }

} 