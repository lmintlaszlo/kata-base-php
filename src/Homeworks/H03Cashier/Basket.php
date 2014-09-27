<?php

namespace Kata\Homeworks\H03Cashier;

class Basket
{
    /**
     * Contains the products stored in the basket.
     *
     * @var array
     */
    private $products = array();

    /**
     * Adds a product to the basket. Either by adding a new or incrementing
     * the amount.
     *
     * @param array $product
     *
     * @return bool
     */
    public function add(array $product)
    {
        $productName = array_shift($product);

        if (!array_key_exists($productName, $this->products))
        {

            $this->products[$productName] = $product;
        }
        else
        {
            $this->products[$productName]['amount']++;
        }

        return true;
    }

    public function getProducts()
    {
        return $this->products;
    }
}
