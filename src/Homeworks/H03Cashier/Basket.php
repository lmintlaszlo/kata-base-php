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
     * @param $product Product
     *
     * @return bool
     */
    public function add(Product $product)
    {
        $productName = $product->getName();

        if (!array_key_exists($productName, $this->products))
        {

            $this->products[$productName] = $product;
        }
        else
        {
            $newAmount = $this->products[$productName]->getAmount() + $product->getAmount();
            $this->products[$productName]->setAmount($newAmount);
        }

        return true;
    }

    /**
     * Returns the products in the basket.
     *
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }
}
