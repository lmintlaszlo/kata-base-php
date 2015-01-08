<?php

use Kata\Lessons\L06Exam\StringCalculator;


class StringCalculatorTest extends PHPUnit_Framework_TestCase
{
    private $stringCalculator;
    
    public function setUp()
    {
        $this->stringCalculator = new StringCalculator();
    }
    
    public function testAdd()
    {
        $this->assertEquals(0, $this->stringCalculator->add(''));
    }
}