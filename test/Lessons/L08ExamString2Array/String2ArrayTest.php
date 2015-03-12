<?php

use Kata\Lessons\L08ExamString2Array\String2Array;

class String2ArrayTest extends PHPUnit_Framework_TestCase
{
    private $string2Array;
    
    public function setUp()
    {
        $this->string2Array = new String2Array();
    }
    
    /**
     * @expectedException \Kata\Lessons\L08ExamString2Array\Exceptions\InvalidStringException
     * @dataProvider providerOneLineForException
     */
    public function testOneLineForException($notString)
    {
        $this->string2Array->oneLine($notString);
    }
    
    
    public function providerOneLineForException()
    {
        return array(
            array(1),
            array(true),
            array(array()),
        );
    }
}
