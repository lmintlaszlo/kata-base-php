<?php

use Kata\Homeworks\H03Cashier\Basket;
use Kata\Homeworks\H03Cashier\Apple;


class BasketTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Kata\Homeworks\H03Cashier\Basket::add
     * @uses Kata\Homeworks\H03Cashier\Product
     * @dataProvider addDataProvider
     */
    public function testAdd($products)
    {
        $basket = new Basket();
        
        foreach ($products as $product)
        {
            $this->assertTrue($basket->add($product));
        }
    }

    /**
     * @covers Kata\Homeworks\H03Cashier\Basket::getProducts
     * @uses Kata\Homeworks\H03Cashier\Basket
     * @uses Kata\Homeworks\H03Cashier\Product
     * @dataProvider getProductsDataProvider
     */
    public function testGetProducts($expectedProducts, $products)
    {
        $basket = new Basket();
        
        // Adding products
        foreach ($products as $product)
        {
            $this->assertTrue($basket->add($product));
        }
        
        $productsInBasket = $basket->getProducts();
        
        foreach ($productsInBasket as $productName => $product)
        {
            $this->assertEquals($expectedProducts[$productName], $product->getAmount());
        }
    }




    /** Data providers */

    /**
     * Data provider for testAdd method
     */
    public function addDataProvider()
    {
        return array(
            array(
                array(
                    new Apple(5),
                    new Apple(2),
                ),
            ),
        );
    }

    /**
     * Data provider for testGetProducts method
     */
    public function getProductsDataProvider()
    {
        return array(
            array(
                array(
                    'Apple' => 7,
                ),
                array(
                    new Apple(5),
                    new Apple(2),
                ),
            ),
        );
    }

} 