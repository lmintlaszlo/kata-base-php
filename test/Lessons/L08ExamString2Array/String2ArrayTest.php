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
     * @param type $string  The string
     * 
     * @expectedException \Kata\Lessons\L08ExamString2Array\Exceptions\InvalidStringException
     * 
     * @dataProvider providerOneLineForException
     */
    public function testOneLineForException($notString)
    {
        $this->string2Array->oneLine($notString);
    }
    
    /**
     * Checks if the method can expode a string by commas.
     * 
     * @param type $string  The string
     * 
     * @dataProvider providerOneLineReturnsArray
     */
    public function testOneLineReturnsArray($string)
    {
        $this->assertInternalType('array', $this->string2Array->oneLine($string));
    }
    
    /**
     * Checks if the method does its job.
     * 
     * @param type $string  The string
     * 
     * @dataProvider providerOneLine
     */
    public function testOneLine($string, $expectedArray)
    {
        
        $returned = $this->string2Array->oneLine($string);
        
        print_r($returned);
        print_r($expectedArray);
        
        $this->assertEquals($expectedArray, $returned);
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
            array(""),
            array("asdf"),
            array("asdf, fdas,dsaff"),
        );
    }
    
    public function providerOneLine()
    {
        return array(
            array("",                    array("lines" => array(""), "values" => array(""))),
            array("asdf",                array("lines" => array("asdf"), "values" => array("asdf"))),
            array("asdf, fdas,dsaff",    array("lines" => array("asdf, fdas,dsaff"), "values"  => array("asdf"," fdas","dsaff"))),
            array("asdf, fdas,twrtwe",   array("lines" => array("asdf, fdas,twrtwe"), "values" => array("asdf", " fdas","twrtwe"))),            
            array("211,22,35\n10,20,33", array("lines" => array("211,22,35", "10,20,33"), "values" => array("211","22","35","10","20","33"))),
        );
    }
}
