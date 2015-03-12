<?php

use Kata\Homeworks\H07OneClick\DataMapper;
use Kata\Homeworks\H07OneClick\OneClick;
use Kata\Homeworks\H07OneClick\Ccbill;

class DataMapperTest extends \PHPUnit_Framework_TestCase
{
    const VALID_SUBSCRIPTION_ID = 'asd1234';
    const EMPTY_METHOD = '';
    
    private $dataMapper;
    
    public function setUp()
    {
        $this->dataMapper = new DataMapper();
    }
    
    public function testMapByObject()
    {
        $method = OneClick::METHOD_CCBILL;
        $params = array(
            OneClick::PARAM_PARAMS => array(
                Ccbill::REQUIRED_SUBSCRIPTION_ID => self::VALID_SUBSCRIPTION_ID,
            )
        );
        
        // Payment manager mock
        $session = $this->getMock(
            '\Kata\Homeworks\H07OneClick\payment_manager',
            array('getData')
        );
        
        $session
            ->expects($this->exactly(2))
            ->method('getData')
            ->will($this->onConsecutiveCalls($method, $params));
        
        $this->assertInstanceOf('Kata\Homeworks\H07OneClick\MappedData', $this->dataMapper->mapByObject($session));
    }

    /**
     * @expectedException \Kata\Homeworks\H07OneClick\Exceptions\InvalidMethodException
     */
    public function testMapByObjectMethodException()
    {
        $method = self::EMPTY_METHOD;
        $params = array(
            OneClick::PARAM_PARAMS => array(
                Ccbill::REQUIRED_SUBSCRIPTION_ID => self::VALID_SUBSCRIPTION_ID,
            )
        );
        
        // Payment manager mock
        $session = $this->getMock(
            '\Kata\Homeworks\H07OneClick\payment_manager',
            array('getData')
        );
        
        $session
            ->expects($this->exactly(2))
            ->method('getData')
            ->will($this->onConsecutiveCalls($method, $params));
        
        $this->dataMapper->mapByObject($session);
    }
    
    /**
     * @expectedException Kata\Homeworks\H07OneClick\Exceptions\InvalidParamsException
     */
    public function testMapByObjectParamsException()
    {
        $method = OneClick::METHOD_CCBILL;
        $params = array();
        
        // Payment manager mock
        $session = $this->getMock(
            '\Kata\Homeworks\H07OneClick\payment_manager',
            array('getData')
        );
        
        $session
            ->expects($this->exactly(2))
            ->method('getData')
            ->will($this->onConsecutiveCalls($method, $params));
        
        $this->dataMapper->mapByObject($session);
    }
    
    
    public function testMapByArray()
    {
        $array = array(
            OneClick::PARAM_METHOD => OneClick::METHOD_CCBILL,
            OneClick::PARAM_PARAMS => array(
                Ccbill::REQUIRED_SUBSCRIPTION_ID => self::VALID_SUBSCRIPTION_ID,
            )
        );
        
        $this->assertInstanceOf(
            'Kata\Homeworks\H07OneClick\MappedData',
            $this->dataMapper->mapByArray($array)
        );
    }
    
    /**
     * @expectedException \Kata\Homeworks\H07OneClick\Exceptions\InvalidMethodException
     */
    public function testMapByArrayMethodException()
    {
        $array = array(
            OneClick::PARAM_METHOD => self::EMPTY_METHOD,
            OneClick::PARAM_PARAMS => array(
                Ccbill::REQUIRED_SUBSCRIPTION_ID => self::VALID_SUBSCRIPTION_ID,
            )
        );
        
        $this->assertInstanceOf(
            'Kata\Homeworks\H07OneClick\MappedData',
            $this->dataMapper->mapByArray($array)
        );
    }
    
    
    
    /**
     * @expectedException \Kata\Homeworks\H07OneClick\Exceptions\InvalidParamsException
     */
    public function testMapByArrayParamsException()
    {
        $array = array(
            OneClick::PARAM_METHOD => OneClick::METHOD_CCBILL,
            OneClick::PARAM_PARAMS => array()
        );
        
        $this->assertInstanceOf(
            'Kata\Homeworks\H07OneClick\MappedData',
            $this->dataMapper->mapByArray($array)
        );
    }
}
