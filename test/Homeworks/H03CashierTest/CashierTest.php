<?php

use Kata\Homeworks\H03Cashier\Cashier;

class CashierTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Kata\Homeworks\H03Cashier\Cashier::calculate
     * @param $expectedPrice
     * @dataProvider calculateDataProvider
     */
    public function testCalculate($expectedPrice, $basket)
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
        return array(
            array(6,
                array(
                    array('price' => 2, 'amount' => 1),
                    array('price' => 2, 'amount' => 1),
                    array('price' => 2, 'amount' => 1),
                )
            ),
        );
    }

} 