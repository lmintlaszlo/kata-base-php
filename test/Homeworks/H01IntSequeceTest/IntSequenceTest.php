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
    public function testConstructorInvalidInteger($sequence)
    {
        new IntSequence($sequence);
    }


    /**
     * Test the calculateMin() function.
     *
     * @param $sequence
     * @param $expectedMin
     *
     * @dataProvider calculateMinDataProvider
     */
    public function testCalculateMin($sequence, $expectedMin)
    {
        $intSequence = new IntSequence($sequence);
        $this->assertEquals($expectedMin, $intSequence->calculateMin());
    }

    /**
     * Test the calculateMax() function.
     *
     * @param $sequence
     * @param $expectedMax
     *
     * @dataProvider calculateMaxDataProvider
     */
    public function testCalculateMax($sequence, $expectedMax)
    {
        $intSequence = new IntSequence($sequence);
        $this->assertEquals($expectedMax, $intSequence->calculateMax());
    }

    /**
     * Test the calculateQuantity() function.
     *
     * @param $sequence
     * @param $expectedQuantity
     *
     * @dataProvider calculateQuantityDataProvider
     */
    public function testCalculateQuantity($sequence, $expectedQuantity)
    {
        $intSequence = new IntSequence($sequence);
        $this->assertEquals($expectedQuantity, $intSequence->calculateQuantity());
    }

    /**
     * Test the calculateAverage() function.
     *
     * @param $sequence
     * @param $expectedAverage
     *
     * @dataProvider calculateAverageDataProvider
     */
    public function testCalculateAverage($sequence, $expectedAverage)
    {
        $intSequence = new IntSequence($sequence);
        $this->assertEquals($expectedAverage, $intSequence->calculateAverage());
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

    /**
     * Data provider for testCalculateMin method.
     *
     * @return array
     */
    public function calculateMinDataProvider()
    {
        return array(
            array(array(0,2,3), 0),
            array(array(1,2,3), 1),
            array(array(2,2,3), 2),
        );
    }

    /**
     * Data provider for testCalculateMax method.
     *
     * @return array
     */
    public function calculateMaxDataProvider()
    {
        return array(
            array(array(0,2,3), 3),
            array(array(1,2,3), 3),
            array(array(2,2,4), 4),
        );
    }

    /**
     * Data provider for testCalculateQuantity method.
     *
     * @return array
     */
    public function calculateQuantityDataProvider()
    {
        return array(
            array(array(2,2), 2),
            array(array(0,2,3), 3),
            array(array(1,2,3,4), 4),
        );
    }

    /**
     * Data provider for testCalculateAverage method.
     *
     * @return array
     */
    public function calculateAverageDataProvider()
    {
        return array(
            array(array(2,2), (4/2)),
            array(array(0,2,3), (5/3)),
            array(array(1,2,3,4), (10/4)),
        );
    }
}