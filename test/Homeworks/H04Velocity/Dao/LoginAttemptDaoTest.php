<?php

use Kata\Homeworks\H04Velocity\Dao\LoginAttemptDao;


class LoginAttemptDaoTest  extends \PHPUnit_Framework_TestCase
{
    private static $connection;
    private $loginAttemptDao;
    
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
        $this->loginAttemptDao = new LoginAttemptDao(self::$connection);
        $this->loginAttemptDao->resetTable();
    }
    
    
    public function tearDown()
    {
        $this->loginAttemptDao = null;
    }


    public function testResetTable()
    {        
        $sql = "SELECT COUNT(*) as `sum` FROM `login` WHERE `username` = 'pityu'" .
               " AND `password` = 'pityu' AND `country` = 'hungary'";
        
        $stmt = self::$connection->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetch();
        
        $this->assertEquals(1, $result['sum']);
    }
    
    
    /**
     * @dataProvider getStoredPropertiesByUsernameProvider
     * @param string $username
     */
    public function testGetStoredPropertiesByUsername($username)
    {        
        $storedProperties = $this->loginAttemptDao->
                getStoredPropertiesByUsername($username);

        /** @todo Szerintem ez itt  mar kod duplikacio */
        
        $sql = "SELECT * FROM `login` WHERE `username` = :username";
        
        $stmt = self::$connection->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch();

        $this->assertEquals(array_keys($storedProperties), array_keys($result));
        $this->assertEquals(array_values($storedProperties), array_values($result));
    }
    
    /**
     * @dataProvider getAStoredPropertyByUsernameProvider
     * @param string $username
     */
    public function testGetAStoredPropertyByUsername($username, $property, $expectedValue)
    {
        $storedProperties = $this->loginAttemptDao->getAStoredPropertyByUsername($username, $property);

        $this->assertEquals($expectedValue, $storedProperties);
    }
    
    
    /** Data providers */
    
    public function getStoredPropertiesByUsernameProvider()
    {
        return array(
            array('pityu'),
        );
    }
    
    
    public function getAStoredPropertyByUsernameProvider()
    {
        return array(
            array('pityu', 'username', 'pityu'),
            array('pityu', 'password', 'pityu'),
            array('pityu', 'country', 'hungary'),
            array('pityu', 'nincsilyen', null),
        );
    }
}
