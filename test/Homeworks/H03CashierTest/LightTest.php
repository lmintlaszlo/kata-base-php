<?php

use Kata\Homeworks\H03Cashier\Light;

class LightTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Kata\Homeworks\H03Cashier\Light::__construct
     * @uses Kata\Homeworks\H03Cashier\Discount
     * @uses Kata\Homeworks\H03Cashier\Product
     */
    public function testConstructor()
    {
        $light = new Light(5);
        
        $this->assertInstanceOf('Kata\Homeworks\H03Cashier\Light', $light);
    }
    
}
