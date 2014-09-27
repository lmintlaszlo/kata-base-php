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
        $sumPrice = 0;

        foreach($basket->getProducts() as $productName => $product)
        {
            $unitPrice    = $product['price'];
            $extraProduct = false;

            if (isset($product['minAmountForDiscount']) && $product['amount'] >= $product['minAmountForDiscount'])
            {
                switch ($product['discountType'])
                {
                    case 'cheaperProduct' : $unitPrice    = $product['discountValue']; break;
                    case 'extraProduct'   : $extraProduct = true; break;
                }
            }

            //echo $productName . ": " . $product['amount'] . ' * ' . $unitPrice . PHP_EOL;
            $sumPrice = $sumPrice + ($unitPrice * $product['amount']);

            if ($extraProduct)
            {
                $basket->addExtraProduct($product);
            }
        }

        return $sumPrice;
    }

} 