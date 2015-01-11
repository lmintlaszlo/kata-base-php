<?php

use Kata\Lessons\L06OrderHandler\OrderDao;


class OrderDaoTest extends \PHPUnit_Framework_TestCase
{
    private static $connection;
    private $orderDao;
    
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
    
    /**
     * 
     */
    public function setUp()
    {
        $this->orderDao = new OrderDao(self::$connection, 'ip');
        // $this->orderDao->resetTable();
    }
    
    /**
     * 
     */
    public function tearDown()
    {
        $this->orderDao = null;
    }
    
    
}
