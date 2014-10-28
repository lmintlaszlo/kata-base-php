<?php

use Kata\Homeworks\H04Velocity\Counter\Ip;


class IpTest extends \PHPUnit_Framework_TestCase
{
    private static $connection;
    private $ipCounter;
    private $value = '1.2.5.8';
    
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
        $this->ipCounter = new Ip($this->value, self::$connection);
        $this->ipCounter->resetTable();
    }
    
    
    public function tearDown()
    {
        $this->ipCounter = null;
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
     * @dataProvider incrementProvider
     */
    public function testIncrement($incrementNumber)
    {
        for($i=0; $i<$incrementNumber; $i++)
        {
            $this->ipCounter->increment();
        }
        
        $sql  = "SELECT `counter` FROM `ip` WHERE value = '" . $this->value . "'";
        
        $stmt = self::$connection->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch();

        $this->assertEquals($incrementNumber, $result['counter']);
    }

    /**
     * @param type $counter
     * @param type $expectedResult
     * 
     * @dataProvider isLimitReachedProvider
     */
    public function testIsLimitReached($counter, $expectedResult)
    {   
        $sql = "INSERT INTO `ip` (`counter`,`value`) VALUES (:counter, :value)";
        
        $stmt = self::$connection->prepare($sql);
        $stmt->bindParam(':counter', $counter);
        $stmt->bindParam(':value', $this->value);
        $stmt->execute();

        $this->assertEquals($expectedResult, $this->ipCounter->isLimitReached());
    }
    
    public function testSetToLimit()
    {
        $this->ipCounter->setToLimit();
        
        $sql = "SELECT `counter` FROM `ip` WHERE `value` = :value";
        
        $stmt = self::$connection->prepare($sql);
        $stmt->bindParam(':value', $this->value);
        $stmt->execute();
        $result = $stmt->fetch();
        
        $this->assertEquals(3, $result['counter']);
        
        
    }
    
    /**
     * @param type $value
     * @param type $counter
     * 
     * @dataProvider getCountProvider
     */
    public function testGetCount($counter)
    {
        $sql = "INSERT INTO `ip` (`counter`,`value`) VALUES (:counter, :value)";
        
        $stmt = self::$connection->prepare($sql);
        $stmt->bindParam(':counter', $counter);
        $stmt->bindParam(':value', $this->value);
        $stmt->execute();

        $this->assertEquals($counter, $this->ipCounter->getCount());
    }
    
    
    /** Data providers */
    
    public function incrementProvider()
    {
        return array(
            array(1),
            array(3),
            array(5),
            array(17),
        );
    }
    
    public function isLimitReachedProvider()
    {
        return array(
            array(0, false),
            array(1, false),
            array(2, false),
            array(3, true),
            array(4, true),
            array(5, true),
        );
    }
    
    public function getCountProvider()
    {
        return array(
            array(1),
            array(27),
            array(22),
            array(4),
        );
    }
    
    
}
