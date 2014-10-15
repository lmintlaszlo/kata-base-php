<?php

use Kata\Homeworks\H03Cashier\Basket;
use Kata\Homeworks\H03Cashier\Apple;
use Kata\Homeworks\H03Cashier\Light;
use Kata\Homeworks\H03Cashier\Starship;

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

} 