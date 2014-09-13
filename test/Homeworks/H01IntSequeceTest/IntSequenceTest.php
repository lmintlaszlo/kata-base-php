<?php

use Kata\Homeworks\H01IntSequence\IntSequence;
use Kata\Homeworks\H01IntSequence\InvalidIntegerException;

class IntSequenceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests the constructor.
     *
     * @param $sequence
     *
     * @dataProvider constructorDataProvider
     */
    public function testConstructor($sequence)
    {
        $intSequence = new IntSequence($sequence);
        $this->assertEquals($sequence, $intSequence->getSequence());
    }


    /**
     * Test the constructor for invalid argument exceptions.
     *
     * @param $sequence
     *
     * @expectedException InvalidArgumentException
     * @dataProvider constructorInvalidArgumentDataProvider
     */
    public function testConstructorInvalidArgument($sequence)
    {
        new IntSequence($sequence);
    }


    /**
     * Test the constructor for invalid integer exceptions.
     *
     * @param $sequence
     *
     * @expectedException InvalidIntegerException
     * @dataProvider constructorInvalidIntegerDataProvider
     */
    public function _testConstructorInvalidInteger($sequence)
    {
        new IntSequence($sequence);
    }


    /* Data providers */

    /**
     * Data provider for testConstructor method.
     *
     * @return array
     */
    public function constructorDataProvider()
    {
        return array(
            array(array()),
        );
    }

    /**
     * Data provider for testConstructorInvalidArgument method.
     *
     * @return array
     */
    public function constructorInvalidArgumentDataProvider()
    {
        return array(
            array(1),
            array('1'),
            array(new stdClass()),
        );
    }

    /**
     * Data provider for testConstructorWithException method.
     *
     * @return array
     */
    public function constructorInvalidIntegerDataProvider()
    {
        return array(
            array(array(1,1,1,1,1)),
            array(array('1',1,1,1)),
            array(array(new stdClass(),1)),
        );
    }
}