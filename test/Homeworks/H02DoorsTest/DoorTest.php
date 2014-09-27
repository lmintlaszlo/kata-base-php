<?php

use Kata\Homeworks\H02Doors\Door;

class DoorTest extends PHPUnit_Framework_TestCase
{

    /**
     * @param $doorNumber int  The number of the door
     *
     * @expectedException Kata\Homeworks\H01IntSequence\InvalidIntegerException
     * @dataProvider constructorExceptionDataProvider
     */
    public function testConstructorException($doorNumber)
    {
        new Door($doorNumber);
    }

    /**
     * @param $doorNumber             int     The number of the door
     * @param $doorExpectedFinalState boolean The expected final state of the door
     *
     * @dataProvider doorFinalStateDataProvider
     */
    public function testDoorFinalState($doorNumber, $doorExpectedFinalState)
    {
        $door = new Door($doorNumber);
        $this->assertEquals($doorExpectedFinalState, $door->getFinalState());
    }

    /** Data providers */

    /**
     * Data provider for testDoorFinalState method,
     *
     * @return array
     */
    public function doorFinalStateDataProvider()
    {
        return array(
            array(1, true),
            array(2, false),
            array(3, false),
            array(4, true),
            array(5, false),
            array(6, false),
            array(7, false),
            array(8, false),
            array(9, true),
            array(10, false),
            array(16, true),
            array(25, true),
            array(36, true),
            array(49, true),
            array(64, true),
            array(81, true),
            array(100, true),
        );
    }

    /**
     * Data provider for testConstructorException method.
     *
     * @return array
     */
    public function constructorExceptionDataProvider()
    {
        return array(
            array(null),
            array(array()),
            array('1'),
            array(true),
        );
    }
}