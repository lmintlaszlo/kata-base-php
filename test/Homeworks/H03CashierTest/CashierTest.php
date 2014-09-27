<?php

use Kata\Homeworks\H03Cashier\Cashier;

class CashierTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Kata\Homeworks\H03Cashier\Cashier::calculate
     * @param $expectedPrice
     * @dataProvider calculateDataProvider
     */
    public function testCalculate($expectedPrice, $price, $amount)
    {
        $cashier = new Cashier();
        $this->assertEquals($expectedPrice, $cashier->calculate($price, $amount));
    }

    /** Data providers */

    /**
     * Data provider for testCalculate method
     */
    public function calculateDataProvider()
    {
        return array(
            array(2, 2, 1),
        );
    }

} 