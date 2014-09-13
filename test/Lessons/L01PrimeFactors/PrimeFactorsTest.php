<?php

use Kata\Lessons\L01PrimeFactors\PrimeFactors;


class PrimeFactorsTest extends PHPUnit_Framework_TestCase {

    /**
     * Test method for PrimeFactors->getPrimeFactors.
     *
     * @dataProvider primeDataProvider
     */
    public function testPrimeFactors($number, array $expectedPrimeFactors)
    {
        $primeFactors = new PrimeFactors();

        $this->assertEquals($expectedPrimeFactors, $primeFactors->getPrimeFactors($number));
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



}
