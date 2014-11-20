<?php

use Kata\Homeworks\H06RegistrationApi\Generator;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    private $generator;
    
    public function setUp()
    {
        $this->generator = new Generator();
    }
    
    public function testGetPassword()
    {
        $password = $this->generator->getPassword();
        $passwordLength = strlen($password);
        
        $this->assertNotEmpty($password);
        $this->assertInternalType('string', $password);
        $this->assertTrue($passwordLength > 7);
        $this->assertTrue($passwordLength < 17);
    }
    
    public function testGetSaltedHash()
    {
        $saltedHash = $this->generator->getSaltedHash();
        
        $this->assertNotEmpty($saltedHash);
        $this->assertInternalType('string', $saltedHash);
        $this->assertEquals(40, strlen($saltedHash));
    }
    
    public function testGenerateSaltedHashFromPlain()
    {
        $saltedHash = $this->generator->generateSaltedHashFromPlain('sd');
        
        $this->assertNotEmpty($saltedHash);
        $this->assertInternalType('string', $saltedHash);
        $this->assertEquals(40, strlen($saltedHash));
    }
    
    
}
