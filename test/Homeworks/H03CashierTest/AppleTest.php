<?php

use Kata\Homeworks\H03Cashier\Apple;

class AppleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Kata\Homeworks\H03Cashier\Apple::__construct
     * @uses Kata\Homeworks\H03Cashier\Discount
     * @uses Kata\Homeworks\H03Cashier\Product
     */
    public function testConstructor()
    {
        $apple = new Apple(5);
        
        $this->assertInstanceOf('Kata\Homeworks\H03Cashier\Apple', $apple);
    }
}
