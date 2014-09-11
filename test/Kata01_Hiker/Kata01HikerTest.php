<?php

use Kata\Kata01Hiker\Hiker;


class Kata01HikerTest extends PHPUnit_Framework_TestCase {

    /**
     * @dataProvider primeDataProvider
     */
    public function testHiker()
    {
        $hiker = new Hiker();

        $this->assertEquals(array(2),$hiker->getPrimeFactor(2));
        $this->assertEquals(array(3),$hiker->getPrimeFactor(3));
        $this->assertEquals(array(2,2),$hiker->getPrimeFactor(4));
        $this->assertEquals(array(3,2),$hiker->getPrimeFactor(6));
        $this->assertEquals(array(3,2,2),$hiker->getPrimeFactor(12));
    }

    public function primeDataProvider()
    {
        return array (
            array()
        );
    }



}
