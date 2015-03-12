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
     * Checks if the method throws exception on not string input.
     * 
     * @expectedException \Kata\Lessons\L08ExamString2Array\Exceptions\InvalidStringException
     * @dataProvider providerOneLineForException
     */
    public function testOneLineForException($notString)
    {
        $this->string2Array->oneLine($notString);
    }
    
    /**
     * Checks if the method can expode a string by commas.
     * 
     * @dataProvider providerOneLineReturnsArray
     */
    public function testOneLineReturnsArray($string)
    {
        $this->assertInternalType('array', $this->string2Array->oneLine($string));
    }
    
    
    /** Data providers */
    
    public function providerOneLineForException()
    {
        return array(
            array(1),
            array(true),
            array(array()),
        );
    }
    
    public function providerOneLineReturnsArray()
    {
        return array(
            array(''),
            array('asdf'),
            array('asdf, fdas,dsaff'),
        );
    }
}
