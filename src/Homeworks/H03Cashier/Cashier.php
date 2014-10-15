<?php

namespace Kata\Homeworks\H03Cashier;

class Cashier
{

    /**
     * Calculates the price of goods in a basket.
     *
     * @param $basket Basket
     * @return float
     */
    public function calculate(Basket $basket)
    {
        $sumPrice = 0;

        foreach($basket->getProducts() as $productName => $product)
        {
            $price    = $product->getPriceForCashier();
            $amount   = $product->getAmountForCashier();
            $sumPrice = $sumPrice + ($price * $amount);
            
            // echo $product->getName() . ' - ' . $product->getAmount() . ' . ' . $product->getPrice() . PHP_EOL;
            // echo $product->getName() . ' - ' . $amount . ' . ' . $price . PHP_EOL;
        }

        return $sumPrice;
    }

}