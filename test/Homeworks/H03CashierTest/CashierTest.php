<?php

use Kata\Homeworks\H03Cashier\Cashier;
use Kata\Homeworks\H03Cashier\Basket;
use Kata\Homeworks\H03Cashier\Apple;
use Kata\Homeworks\H03Cashier\Light;
use Kata\Homeworks\H03Cashier\Starship;

class CashierTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Kata\Homeworks\H03Cashier\Cashier::calculate
     * @uses Kata\Homeworks\H03Cashier\Basket
     * @uses Kata\Homeworks\H03Cashier\Product
     * @uses Kata\Homeworks\H03Cashier\Discount
     * @param $expectedPrice
     * @param $basket Basket
     * @dataProvider calculateDataProvider
     */
    public function testCalculate($expectedPrice, Basket $basket)
    {
        $cashier = new Cashier();
        $this->assertEquals($expectedPrice, $cashier->calculate($basket));
    }


    /** Data providers */

    /**
     * Data provider for testCalculate method
     */
    public function calculateDataProvider()
    {
        $basket = new Basket();

        $basket->add(new Apple(6));
        $basket->add(new Light());
        $basket->add(new Starship(3));

        return array(
            array(2164.98, $basket),
        );
    }
}
