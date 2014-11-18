<?php

use Kata\Homeworks\H06RegistrationApi\Generator;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    private $generator;
    
    public function setUp()
    {
        $this->generator = new Generator();
    }
    
    public function testGenerator()
    {
        $this->assertRegExp('/[a-z0-9]{32}/', $this->generator->generate());
    }
}
