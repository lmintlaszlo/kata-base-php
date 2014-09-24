<?php

use Kata\Homeworks\H02Doors\Door;

class DoorTest extends PHPUnit_Framework_TestCase
{

    /**
     * @param $doorNumber  The number of the door
     *
     * @expectedException Kata\Homeworks\H01IntSequence\InvalidIntegerException
     * @dataProvider constructorExceptionDataProvider
     */
    public function testConstructorException($doorNumber)
    {
        new Door($doorNumber);
    }

    /**
     * @param $doorNumber              The number of the door
     * @param $doorExpectedFinalState  The expected final state of the door
     *
     * @dataProvider doorFinalStateDataProvider
     */
    public function testDoorFinalState($doorNumber, $doorExpectedFinalState)
    {
        $door = new Door($doorNumber);
        $this->assertEquals($doorExpectedFinalState, $door->getFinalState());
    }


    public function doorFinalStateDataProvider()
    {
        return array(
            array(5, false),
        );
    }

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