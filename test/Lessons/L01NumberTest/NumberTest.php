<?php

use Kata\Lessons\L01Number\Number;
use Kata\Lessons\L01Number\InvalidNumberException;


class NumberTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * @covers \Kata\Lessons\L01Number\Number::__construct
     * @dataProvider validNumberDataProvider 
     */
    public function testConstructorWithValidNumber($validNumber)
    {
        $numberObject = new Number($validNumber);
        
        $this->assertInstanceOf('\Kata\Lessons\L01Number\Number', $numberObject);
    }
    
    /**
     * @covers \Kata\Lessons\L01Number\Number::__construct
     * @expectedException \Kata\Lessons\L01Number\InvalidNumberException
     * @dataProvider invalidNumberDataProvider 
     */
    public function testConstructorWithInvalidNumber($invalidNumber)
    {
        new Number($invalidNumber);
    }
    
    /**
     * @covers \Kata\Lessons\L01Number\Number::getPrimeFactors
     * @uses Kata\Lessons\L01Number\Number
     * @dataProvider primeDataProvider
     */
    public function testGetPrimeFactors($number, array $expectedPrimeFactors)
    {
        $numberObject = new Number($number);

        $this->assertEquals($expectedPrimeFactors, $numberObject->getPrimeFactors());
    }
    
    /**
     * @covers \Kata\Lessons\L01Number\Number::getNumberOfDividers
     * @uses Kata\Lessons\L01Number\Number
     * @dataProvider dividersDataProvider
     */
    public function testGetNumberOfDividers($number, $expectedDividers)
    {
        $numberObject = new Number($number);

        $this->assertEquals($expectedDividers, $numberObject->getNumberOfDividers());
    }
    
    /**
     * @covers \Kata\Lessons\L01Number\Number::getNumber
     * @uses Kata\Lessons\L01Number\Number
     * @dataProvider validNumberDataProvider
     */
    public function testGetNumber($validNumber)
    {
        $numberObject = new Number($validNumber);
        
        $this->assertEquals($validNumber, $numberObject->getNumber());        
    }
    
    /**
     * @covers \Kata\Lessons\L01Number\Number::getFloatValue
     * @uses Kata\Lessons\L01Number\Number
     * @dataProvider validNumberDataProvider
     */
    public function testGetFloatValue($validNumber)
    {
        $numberObject = new Number($validNumber);
        
        $this->assertInternalType('float', $numberObject->getFloatValue());
    }
    
    /**
     * @covers \Kata\Lessons\L01Number\Number::getIntValue
     * @uses Kata\Lessons\L01Number\Number
     * @dataProvider validNumberDataProvider
     */
    public function testGetIntValue($validNumber)
    {
        $numberObject = new Number($validNumber);
        
        $this->assertInternalType('int', $numberObject->getIntValue());
    }

    /**
     * Data provider for testPrimeFactors.
     *
     * @return array
     */
    public function primeDataProvider()
    {
        return array (
            array(2, array(2)),
            array(3, array(3)),
            array(4, array(2,2)),
            array(5, array(5)),
            array(6, array(2,3)),
            array(9, array(3,3)),
            array(12, array(2,2,3)),
            array(15, array(3,5)),
        );
    }

    /**
     * Data provider for testPrimeFactors.
     *
     * @return array
     */
    public function dividersDataProvider()
    {
        return array (
            array(0, 1),
            array(1, 1),
            array(2, 2),
            array(3, 2),
            array(6, 4),
        );
    }

    /**
     * Data provider for testConstructorWithInvalidNumber.
     * 
     * @return array
     */
    public function invalidNumberDataProvider()
    {
        return array(
            array('string'),
            array(array()),
            array(array('array' => array())),
            array(new stdClass()),
        );
    }

    /**
     * Data provider for testConstructorWithValidNumber.
     * 
     * @return array
     */
    public function validNumberDataProvider()
    {
        return array(
            array(42),
            array(4.2),
            array("42"),
            array(0x539),
            array(0b10100111001),
            array(1337e0),
        );
    }
    
}
