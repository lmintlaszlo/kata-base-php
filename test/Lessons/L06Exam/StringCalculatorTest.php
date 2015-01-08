<?php

use Kata\Lessons\L06Exam\StringCalculator;


class StringCalculatorTest extends PHPUnit_Framework_TestCase
{
    private $stringCalculator;
    
    public function setUp()
    {
        $this->stringCalculator = new StringCalculator();
    }
    
    /**
     * @dataProvider testAddDataProvider
     */
    public function testAdd($provided, $expected)
    {
        $this->assertEquals($expected, $this->stringCalculator->add($provided));
    }
    
    public function testAddDataProvider()
    {
        return array(
            array('', 0),
            array('1', 1),
            array('0,1', 1),
            array('0,,1', 1),
            array('0,2,1', 3),
            array("0\n2,1", 3),
            array("0\n2\n1,1", 4),
        );
    }
}