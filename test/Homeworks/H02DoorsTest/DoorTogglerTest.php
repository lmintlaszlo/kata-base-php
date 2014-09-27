<?php

use Kata\Homeworks\H02Doors\DoorToggler;
use Kata\Homeworks\H02Doors\Door;

class DoorTogglerTest  extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider walkDoorsDataProvider
     */
    public function testWalkDoors($number, $finalState)
    {
        $doorToggler = new DoorToggler();
        $doorToggler->walkDoors();

        $this->assertEquals($finalState, $doorToggler->getDoorStateByNumber($number));
    }


    /** Data providers */

    /**
     * Data provider for testWalkDoors method,
     *
     * @return array
     */
    public function walkDoorsDataProvider()
    {
        $door1 = new Door(1);
        $door2 = new Door(2);

        return array(
            array($door1->getNumber(), $door1->getFinalState()),
            array($door2->getNumber(), $door2->getFinalState()),
        );
    }
} 