<?php

use Kata\Homeworks\H03Cashier\Cashier;
use Kata\Homeworks\H03Cashier\Basket;
use Kata\Homeworks\H03Cashier\Apple;
use Kata\Homeworks\H03Cashier\Light;
use Kata\Homeworks\H03Cashier\Starship;
use Kata\Homeworks\H03Cashier\DiscountPrice;
use Kata\Homeworks\H03Cashier\DiscountPiece;
use Kata\Homeworks\H03Cashier\DiscountNone;

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

        $basket->add(new Apple());
        $basket->add(new Apple(5));
        $basket->add(new Light());
        $basket->add(new Starship());
        $basket->add(new Starship());
        $basket->add(new Starship());

        return array(
            array(2164.98, $basket),
        );
    }
}
