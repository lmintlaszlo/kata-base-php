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
            array(1046.99,
                array(
                    array(
                        'name'                 => 'Apple',
                        'price'                => 32,
                        'amount'               => 1,
                        'amountUnit'           => 'kg',
                        'minAmountForDiscount' => 5,
                        'discountType'         => 'cheaperProduct',
                        'discountValue'        => 25,
                    ),
                    array(
                        'name'   => 'Light',
                        'price'  => 15,
                        'amount' => 1,
                    ),
                    array(
                        'name'                 => 'Starship',
                        'price'                => 999.99,
                        'amount'               => 1,
                        'minAmountForDiscount' => 2,
                        'discountType'         => 'extraProduct',
                        'discountValue'        => 1,
                    ),
                )
            ),
        );
    }

} 