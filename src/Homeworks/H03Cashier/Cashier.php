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
            $price  = $product->getPrice();
            $amount = $product->getAmount();

            if ($product->isDiscountAvailable() && $product->isDiscountLimitReached())
            {
                switch ($product->getDiscountType())
                {
                    case Product::DISCOUNT_PRICE :
                        $price = $product->getDiscountValue();
                        break;
                
                    case Product::DISCOUNT_EXTRA :                        
                        $free   = (int)($product->getAmount() / ($product->getMinAmountForDiscount() + $product->getDiscountValue()));
                        $amount = ($amount - $free);
                        break;
                }
            }

            $sumPrice = $sumPrice + ($price * $amount);
        }

        return $sumPrice;
    }

}