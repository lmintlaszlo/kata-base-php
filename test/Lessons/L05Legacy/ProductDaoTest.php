<?php

use Kata\Lessons\L05Legacy\Product;
use Kata\Lessons\L05Legacy\ProductDao;

define('PRODUCTION_DATABASE_FILE', './product.db');

class ProductDaoTest
{
    private static $connection;
    private $productDao;
    
    /**
     * Megnyitom a mysql kapcsolatot, amit a tesz majd vegig hasznalni fog.
     */
    public static function setUpBeforeClass()
    {
        try
        {
            $dsn = sprintf("sqlite:%s", PRODUCTION_DATABASE_FILE);
	    self::$connection = new PDO($dsn);
	    self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
        $this->productDao = new ProductDao(self::$connection);
    }
    
    
    public function tearDown()
    {
        $this->productDao = null;
    }
    
    /**
     * @dataProvider getByEanProvider
     * @param string $ean
     */
    public function testGetByEan($ean)
    {
        $product = $this->productDao->getByEan($ean);
        
        $sth = $this->pdo->prepare("SELECT * FROM product WHERE ean = :ean");
	$sth->execute(array(':ean' => $ean));

	$row = $sth->fetch();
        
        $this->assertEquals($row['ean'], $product->ean);
        
    }
    
    /**
     * @dataProvider getByIdDataProvider
     * @param int $id
     */
    public function testGetById($id)
    {
        $product = $this->productDao->getById($id);
        
        $sth = $this->pdo->prepare("SELECT * FROM product WHERE id = :id");
	$sth->execute(array(':id' => $id));

	$row = $sth->fetch();
        
        $this->assertEquals($row['id'], $product->id);
    }
    
    
    public function testCreate()
    {
        /** Ez mehetne provider-be */
        $product = new Product();
        $product->ean  = '1001AS11';
        $product->name = 'Horse';
        
        $this->assertTrue($this->productDao->create($product));
    }
    
    public function testModify()
    {
        /** Ez mehetne provider-be */
        $product = new Product();
        $product->id   = 10;
        $product->ean  = '2222FSDFGw322';
        $product->name = 'Horse modified';
        
        /** 
         * Mivel a modify mindig true-t ad vissza ezert sql-t kene irni, 
         * hogy tenyleg modosult-e.
         */
        $this->assertTrue($this->productDao->modify($product));
    }
    
    public function testDelete()
    {
        /** Ez mehetne provider-be */
        $product = new Product();
        $product->id   = 10;
        $product->ean  = '2222FSDFGw322';
        $product->name = 'Horse modified';
        
        /** 
         * Mivel a delete mindig true-t ad vissza ezert sql-t kene irni, 
         * hogy tenyleg torolve van-e.
         */
        $this->assertTrue($this->productDao->delete($product));
        
    }
    
    
    /** Data providers */
    
    public function getByEanDataProvider()
    {
        return array(
            array('nemtom'),
            array('valami'),
            array('barmi'),
        );
    }
    
    public function getByIdDataProvider()
    {
        return array(
            array(1),
            array(5),
            array(2),
        );
    }
}
