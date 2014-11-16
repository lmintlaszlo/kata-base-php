<?php

use Kata\Homeworks\H04Velocity\Dao\CounterDao;


class CounterDaoTest extends \PHPUnit_Framework_TestCase
{
    private static $connection;
    private $counterDao;
    
    /**
     * Megnyitom a mysql kapcsolatot, amit a tesz majd vegig hasznalni fog.
     */
    public static function setUpBeforeClass()
    {
        try
        {
            self::$connection = new \PDO('mysql:host=localhost;dbname=phpunit',
                'phpunit', 'phpunit'
            );            
        }
        catch (Exception $e)
        {
            /** @todo: Megkerdezni, hogy ilyenkor mit lehet tenni? */
        }
    }
    
    /**
     * Lezarom a kapcsolatot.
     */
    public static function teardownAfterClass()
    {
        self::$connection = null;
    }
    
    public function setUp()
    {
        $this->counterDao = new CounterDao(self::$connection, 'ip');
        $this->counterDao->resetTable();
    }
    
    
    public function tearDown()
    {
        $this->counterDao = null;
    }


    public function testResetTable()
    {        
        $sql = "SELECT COUNT(*) as `sum` FROM `ip`";
        
        $stmt = self::$connection->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch();

        $this->assertEquals(0, $result['sum']);
    }
    
    /**
     * @param type $incrementNumber
     * 
     * @dataProvider incrementByValueProvider
     */
    public function testIncrementByValue($value, $incrementNumber)
    {
        for($i=0; $i<$incrementNumber; $i++)
        {
            $this->counterDao->incrementByValue($value);
        }
        
        $sql  = "SELECT `counter` FROM `ip` WHERE value = '" . $value . "'";
        
        $stmt = self::$connection->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch();

        $this->assertEquals($incrementNumber, $result['counter']);
    }

    /**
     * @param type $value
     * @param type $limit
     * 
     * @dataProvider setToLimitByValueProvider
     */
    public function testSetToLimitByValue($value, $limit)
    {
        $this->counterDao->setToLimitByValue($value, $limit);
        
        $sql  = "SELECT `counter` FROM `ip` WHERE value = '" . $value . "'";
        
        $stmt = self::$connection->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch();

        $this->assertEquals($limit, $result['counter']);
    }
    
    /**
     * @param type $value
     * @param type $counter
     * 
     * @dataProvider getCountByValueProvider
     */
    public function testGetCountByValue($value, $counter)
    {
        $sql  = "UPDATE `ip` SET `counter` = :counter WHERE `value` = :value";
        
        $stmt = self::$connection->prepare($sql);
        $stmt->bindParam(':counter', $counter);
        $stmt->bindParam(':value', $value);
        $stmt->execute();

        $result = $stmt->fetch();

        $this->assertEquals($this->counterDao->getCountByValue($value), $result['counter']);
    }
    
    
    /** Data providers */
    
    public function incrementByValueProvider()
    {
        return array(
            array('1.2.3.4', 1),
            array('1.2.3.1', 3),
            array('1.2.3.2', 5),
            array('1.2.3.3', 17),
        );
    }
    
    public function setToLimitByValueProvider()
    {
        return array(
            array('1.2.3.4', 12),
            array('1.2.3.1', 30),
            array('1.2.3.2', 75),
            array('1.2.3.3', 17),
        );
    }
    
    public function getCountByValueProvider()
    {
        return array(
            array('111.111.111.1', 1),
            array('111.111.111.4', 27),
            array('111.111.111.8', 22),
            array('111.111.113.1', 4),
        );
    }
    
    
}
