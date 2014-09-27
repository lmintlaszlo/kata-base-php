<?php

namespace Kata\Homeworks\H03Cashier;

class Cashier
{

    /**
     * Calculates the price of goods in a basket.
     *
     * @return float
     */
    public function calculate(Basket $basket)
    {
        $price = 0;

        foreach($basket->getProducts() as $product)
        {
            $price = $price + ($product['price'] * $product['amount']);
        }

        return $price;
    }

} 