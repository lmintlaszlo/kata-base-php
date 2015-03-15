<?php

use Kata\Homeworks\H07String2Array\String2Array;

class String2ArrayTest extends \PHPUnit_Framework_TestCase
{
    private $string2Array;
    
    public function setUp()
    {
        $this->string2Array = new String2Array();
    }
    
    /**
     * Checks if the method throws exception on not string input.
     * 
     * @param string $notString  The string
     * 
     * @expectedException \Kata\Homeworks\H07String2Array\Exceptions\InvalidStringException
     * 
     * @dataProvider providerStringToArrayForException
     */
    public function testStringToArrayForException($notString)
    {
        $this->string2Array->stringToArray($notString);
    }



    /** Data providers */
    
    public function providerStringToArrayForException()
    {
        return array(
            array(1),
            array(true),
            array(array()),
        );
    }
}
