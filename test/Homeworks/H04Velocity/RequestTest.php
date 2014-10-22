<?php

use Kata\Homeworks\H04Velocity\Request;

class RequestTest extends PHPUnit_Framework_TestCase
{
    const USERNAME   = 'pityu';
    const PASSWORD   = '*****';
    const IP         = '192.168.4.156';
    const IP_RANGE   = '192.168.4.x';
    const IP_COUNTRY = 'Hungary';
    
    protected $request;
    
    protected function setUp()
    {
        $this->request = new Request(
            self::USERNAME,
            self::PASSWORD,
            self::IP,
            self::IP_RANGE,
            self::IP_COUNTRY
        );
    }
    
    public function testGetUsername()
    {
        $this->assertEquals(self::USERNAME, $this->request->getUsername());
    }
    
    public function testGetPassword()
    {
        $this->assertEquals(self::PASSWORD, $this->request->getPassword());
    }
    
    public function testGetIp()
    {
        $this->assertEquals(self::IP, $this->request->getIp());
    }
    
    public function testGetIpRange()
    {
        $this->assertEquals(self::IP_RANGE, $this->request->getIpRange());
    }
    
    public function testGetIpCountry()
    {
        $this->assertEquals(self::IP_COUNTRY, $this->request->getIpCountry());
    }
}
