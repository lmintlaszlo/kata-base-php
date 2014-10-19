<?php

use Kata\Homeworks\H03Cashier\Starship;

class StarshipTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Kata\Homeworks\H03Cashier\Starship::__construct
     * @uses Kata\Homeworks\H03Cashier\Discount
     * @uses Kata\Homeworks\H03Cashier\Product
     */
    public function testConstructor()
    {
        $starship = new Starship(5);
        
        $this->assertInstanceOf('Kata\Homeworks\H03Cashier\Starship', $starship);
    }
    
}

