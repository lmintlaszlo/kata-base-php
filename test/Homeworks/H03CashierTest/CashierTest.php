<?php

use Kata\Homeworks\H03Cashier\Cashier;
use Kata\Homeworks\H03Cashier\Basket;

class CashierTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Kata\Homeworks\H03Cashier\Cashier::calculate
     * @param $expectedPrice
     * @dataProvider calculateDataProvider
     */
    public function testCalculate($expectedPrice, Basket $basket)
    {
        $cashier = new Cashier();
        $this->assertEquals($expectedPrice, $cashier->calculate($basket));

        //print_r($basket->getProducts());
    }

    /** Data providers */

    /**
     * Data provider for testCalculate method
     */
    public function calculateDataProvider()
    {
        $basket = new Basket();

        $basket->add(array(
            'name'                 => 'Apple',
            'price'                => 32,
            'amount'               => 1,
            'amountUnit'           => 'kg',
            'minAmountForDiscount' => 5,
            'discountType'         => 'cheaperProduct',
            'discountValue'        => 25,
        ));

        $basket->add(array(
            'name'                 => 'Apple',
            'price'                => 32,
            'amount'               => 5,
            'amountUnit'           => 'kg',
            'minAmountForDiscount' => 5,
            'discountType'         => 'cheaperProduct',
            'discountValue'        => 25,
        ));

        $basket->add(array(
            'name'   => 'Light',
            'price'  => 15,
            'amount' => 1,
        ));

        $basket->add(array(
            'name'                 => 'Starship',
            'price'                => 999.99,
            'amount'               => 1,
            'minAmountForDiscount' => 2,
            'discountType'         => 'extraProduct',
            'discountValue'        => 1,
        ));

        $basket->add(array(
            'name'                 => 'Starship',
            'price'                => 999.99,
            'amount'               => 1,
            'minAmountForDiscount' => 2,
            'discountType'         => 'extraProduct',
            'discountValue'        => 1,
        ));

        return array(
            array(2164.98, $basket),
        );
    }

} 