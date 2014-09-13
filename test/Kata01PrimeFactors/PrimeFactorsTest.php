<?php

use Kata\Kata01PrimeFactors\PrimeFactors;


class PrimeFactorsTest extends PHPUnit_Framework_TestCase {

    /**
     * @dataProvider primeDataProvider
     */
    public function testPrimeFactors()
    {
        $primeFactors = new PrimeFactors();

        $this->assertEquals(array(2), $primeFactors->getPrimeFactor(2));
        $this->assertEquals(array(3), $primeFactors->getPrimeFactor(3));
        $this->assertEquals(array(2,2), $primeFactors->getPrimeFactor(4));
        $this->assertEquals(array(2,3), $primeFactors->getPrimeFactor(6));
        $this->assertEquals(array(2,2,3), $primeFactors->getPrimeFactor(12));
    }

    public function primeDataProvider()
    {
        return array (
            array()
        );
    }



}
