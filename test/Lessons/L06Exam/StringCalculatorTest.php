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
     * Tests if add works as expected.
     * 
     * @dataProvider addDataProvider
     */
    public function testAdd($provided, $expected)
    {
        $this->assertEquals($expected, $this->stringCalculator->add($provided));
    }

    /**
     * Tests if add thors exception on negatives.
     * 
     * @expectedException \Kata\Lessons\L06Exam\NegativeFoundException
     */
    public function testAddThrowsExcceptionForNegative()
    {
        $this->stringCalculator->add('0,-1,2');
    }
    
    public function addDataProvider()
    {
        return array(
//            array('', 0),
//            array('1', 1),
//            array('0,1', 1),
//            array('0,,1', 1),
//            array('0,2,1', 3),
//            array("0\n2,1", 3),
//            array("0\n2\n1,1", 4),
//            array("//-\n0-2-1-1", 4),
//            array("//#\n0#2#1#1", 4),
            array("//\n\n0\n2\n1\n1", 4),
        );
    }
}