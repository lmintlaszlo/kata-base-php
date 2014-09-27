<?php

use Kata\Homeworks\H03Cashier\Basket;

class BasketTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Kata\Homeworks\H03Cashier\Basket::add
     * @dataProvider addDataProvider
     */
    public function testAdd($products)
    {
        $basket = new Basket();

        foreach ($products as $product)
        {
            $this->assertTrue($basket->add($product));
        }

        $basket->getProducts();

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