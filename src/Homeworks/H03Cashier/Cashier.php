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
            $unitPrice    = $product->getPrice();
            $extraProduct = false;

            if ($product->isDiscountAvailable() && $product->isDiscountLimitReached())
            {
                switch ($product->getDiscountType())
                {
                    case Product::DISCOUNT_CHEAPER : $unitPrice    = $product->getDiscountValue(); break;
                    case Product::DISCOUNT_EXTRA   : $extraProduct = true; break;
                }
            }

            //echo $productName . ": " . $product['amount'] . ' * ' . $unitPrice . PHP_EOL;
            $sumPrice = $sumPrice + ($unitPrice * $product->getAmount());

            if ($extraProduct)
            {
                $basket->addExtraProduct($product);
            }
        }

        return $sumPrice;
    }

} 