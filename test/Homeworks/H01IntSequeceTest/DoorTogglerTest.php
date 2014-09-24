<?php

use Kata\Homeworks\H02Doors\DoorToggler;
use Kata\Homeworks\H02Doors\Door;

class DoorTogglerTest  extends \PHPUnit_Framework_TestCase
{

    public function testWalkDoors()
    {
        $number  = 4;
        $doorToggler = new DoorToggler();
        $doorToggler->walkDoors();

        $door = new Door($number);


        $this->assertEquals($door->getFinalState(), $doorToggler->getDoorStateByNumber($number));
    }


} 