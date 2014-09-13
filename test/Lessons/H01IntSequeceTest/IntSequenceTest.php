<?php

use Kata\Homeworks\H01IntSequence\IntSequence;

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
     * Test the constructor for exceptions.
     *
     * @param $sequence
     *
     * @expectedException InvalidArgumentException
     * @dataProvider constructorWithExceptionDataProvider
     */
    public function testConstructorWithException($sequence)
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
     * Data provider for testConstructorWithException method.
     *
     * @return array
     */
    public function constructorWithExceptionDataProvider()
    {
        return array(
            array(1),
            array('1'),
            array(new stdClass()),
        );
    }
}