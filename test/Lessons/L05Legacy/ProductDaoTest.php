<?php

use Kata\Lessons\L05Legacy\Product;
use Kata\Lessons\L05Legacy\NullProduct;
use Kata\Lessons\L05Legacy\ProductDao;


class ProductDaoTest extends PHPUnit_Framework_TestCase
{
    const TEST_DATABASE_FILE = 'product.db';
    
    private static $connection;
    
    private $productDao;
    
    private $testProductEan  = '011110';
    private $testProductName = 'chair';
    
    private $testProductModifiedEan  = '022220';
    private $testProductModifiedName = 'table';
    
    /**
     * Creates a db connection for the whole test.
     */
    public static function setUpBeforeClass()
    {
        try
        {
            self::$connection = new PDO("sqlite:".realpath(dirname(__FILE__) . '/'.self::TEST_DATABASE_FILE));
	    self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (Exception $e)
        {
            /** @todo: Megkerdezni, hogy ilyenkor mit lehet tenni? */
        }
    }
    
    /**
     * Closes the db connection.
     */
    public static function teardownAfterClass()
    {
        self::$connection = null;
    }
    
    /**
     * Creates a ProductDao instance
     */
    protected function setUp()
    {
        $this->productDao = new ProductDao(self::$connection);        
        
        // Delete the test product to be sure
        $this->directDeleteByEan($this->testProductEan);
    }
    
    
    /**
     * Testing the getByEan method for receiving NullProduct.
     */
    public function testGetByEanReturnsNullProduct()
    {                
        $this->assertInstanceOf(
            '\Kata\Lessons\L05Legacy\NullProduct',
            $this->productDao->getByEan($this->testProductEan)
        );        
    }
    
    /**
     * Testing the getByEan method for receiving Product.
     */
    public function testGetByEanReturnsProduct()
    {
        $this->directInsert($this->testProductEan, $this->testProductName);
                
        $product = $this->productDao->getByEan($this->testProductEan);
                
        $this->assertInstanceOf('\Kata\Lessons\L05Legacy\Product', $product);        
        $this->assertEquals($this->testProductEan, $product->ean);        
        $this->assertEquals($this->testProductName, $product->name);        
    }
    
    /**
     * Testing the getById method for receiving NullProduct.
     */
    public function testGetByIdReturnsNullProduct()
    {                
        $this->assertInstanceOf(
            '\Kata\Lessons\L05Legacy\NullProduct',
            $this->productDao->getById($this->testProductEan)
        );        
    }
    
    /**
     * Testing the getById method for receiving Product.
     */
    public function testGetByIdReturnsProduct()
    {        
        $insertId = $this->directInsert($this->testProductEan, $this->testProductName);
        
        $product = $this->productDao->getById($insertId);

        $this->assertInstanceOf('\Kata\Lessons\L05Legacy\Product', $product);        
        $this->assertEquals($this->testProductEan, $product->ean);        
        $this->assertEquals($this->testProductName, $product->name);        
    }
    
    /**
     * Testing the create method with ProductIsNullException.
     * 
     * @expectedException \Kata\Lessons\L05Legacy\ProductIsNullException
     */
    public function testCreateWithException()
    {
        $product = new NullProduct();
        
        $this->productDao->create($product);
    }
    
    /**
     * Testing the create method with uniq EAN.
     */
    public function testCreateUniq()
    {        
        $product = new Product();
        $product->ean  = $this->testProductEan;
        $product->name = $this->testProductName;
        
        $createResult = $this->productDao->create($product);
        
        $selectedProduct = $this->directSelectByEan($product->ean);
        
        $this->assertTrue($createResult);
        $this->assertEquals($this->testProductEan, $selectedProduct->ean);
        $this->assertEquals($this->testProductName, $selectedProduct->name);
    }
    
    /**
     * Testing the create method with not uniq EAN.
     */
    public function testCreateNotUniq()
    {
        $this->directInsert($this->testProductEan, $this->testProductName);
        
        $newProduct = new Product();
        $newProduct->ean  = $this->testProductEan;
        $newProduct->name = $this->testProductName;
        
        $this->assertFalse($this->productDao->create($newProduct));
    }
    
    /**
     * Testing the modify method throws ProductIsNullException.
     * 
     * @expectedException \Kata\Lessons\L05Legacy\ProductIsNullException
     */
    public function testModifyThrowsIsNullException()
    {
        $product = new NullProduct();
        
        $this->productDao->modify($product);
    }
    
    /**
     * Testing the modify method throws ProductMissingIdException.
     * 
     * @expectedException \Kata\Lessons\L05Legacy\ProductMissingIdException
     */
    public function testModifyThrowsMissingIdException()
    {
        $modifiedEan = '0115110';
        
        $this->directDeleteByEan($modifiedEan);
        $this->directInsert($this->testProductEan, $this->testProductName);
        
        $newProduct = new Product();
        $newProduct->id   = null;
        $newProduct->ean  = $modifiedEan;
        $newProduct->name = $this->testProductName;
        
        $this->productDao->modify($newProduct);
    }
    
    /**
     * Testing the modify method with uniq EAN. 
     */
    public function testModifyWithUniqEan()
    {        
        $this->directDeleteByEan($this->testProductModifiedEan);        
        $insertId = $this->directInsert($this->testProductEan, $this->testProductName);
                
        $newProduct = new Product();
        $newProduct->id   = $insertId;
        $newProduct->ean  = $this->testProductModifiedEan;
        $newProduct->name = $this->testProductModifiedName;
        
        $modifyResult = $this->productDao->modify($newProduct);
        
        $row = $this->directSelectByEan($this->testProductModifiedEan);
       
        $this->assertTrue($modifyResult);
        $this->assertEquals($this->testProductModifiedEan, $row->ean);
        $this->assertEquals($this->testProductModifiedName, $row->name);
    }
    
    /**
     * Testing the modify method with existing uniq EAN. 
     */
    public function testModifyWithExistingUniqEan()
    {        
        $this->directDeleteByEan($this->testProductModifiedEan);        
        $insertId = $this->directInsert($this->testProductEan, $this->testProductName);
                
        $newProduct = new Product();
        $newProduct->id   = $insertId;
        $newProduct->ean  = $this->testProductEan;
        $newProduct->name = $this->testProductModifiedName;
        
        $modifyResult = $this->productDao->modify($newProduct);
        
        $row = $this->directSelectByEan($this->testProductEan);
        
        $this->assertTrue($modifyResult);
        $this->assertEquals($this->testProductEan, $row->ean);
        $this->assertEquals($this->testProductModifiedName, $row->name);
    }
    
    /**
     * Testing the delete method with ProductIsNullException.
     * 
     * @expectedException \Kata\Lessons\L05Legacy\ProductIsNullException
     */
    public function testDeleteThrowsIsNullException()
    {
        $product = new NullProduct();
        
        $this->productDao->delete($product);
    }
    
    /**
     * Testing the delete method throws ProductMissingIdException.
     * 
     * @expectedException \Kata\Lessons\L05Legacy\ProductMissingIdException
     */
    public function testDeleteThrowsMissingIdException()
    {
        $this->directInsert($this->testProductEan, $this->testProductName);
        
        $product = new Product();
        $product->id   = null;
        $product->ean  = $this->testProductEan;
        $product->name = $this->testProductName;
        
        $this->productDao->delete($product);
    }
    
    /**
     * Testing the delete method.
     */
    public function testDelete()
    {
        $insertId = $this->directInsert($this->testProductEan, $this->testProductName);
        
        $product = new Product();
        $product->id   = $insertId;
        $product->ean  = $this->testProductEan;
        $product->name = $this->testProductName;
        
        $deleteResult = $this->productDao->delete($product);
        
        $row = $this->directSelectByEan($this->testProductEan);

        $this->assertTrue($deleteResult);
        $this->assertFalse($row);
    }
    
    /**
     * Inserts a product to the db without using DAO.
     * 
     * @param string $ean   Ean of the product
     * @param string $name  Name of the product
     * @return type
     */
    private function directInsert($ean, $name)
    {
        $insertStmnt = self::$connection->prepare(
            'INSERT INTO product (ean, name) VALUES (:ean, :name)'
        );
        
        $insertStmnt->execute(array(
            ':ean'  => $ean,
            ':name' => $name,
        ));
        
        return self::$connection->lastInsertId();
    }
    
    /**
     * Deletes by EAN directly from the db without using DAO.
     * 
     * @param string $ean  EAN to be deleted
     */
    private function directDeleteByEan($ean)
    {
        $stmnt = self::$connection->prepare('DELETE FROM `product` WHERE `ean` = :ean');
        $stmnt->execute(array(':ean' => $ean));
    }
    
    /**
     * Deletes by id directly from the db without using DAO.
     * 
     * @param type $id  Id to be deleted
     */
    private function directDeleteById($id)
    {
        $stmnt = self::$connection->prepare('DELETE FROM `product` WHERE `id` = :id');
        $stmnt->execute(array(':id' => $id));
    }
    
    /**
     * Selects by EAN directly from the db without using DAO.
     * 
     * @param string $ean  EAN to be selected
     */
    private function directSelectByEan($ean)
    {
        $sth = self::$connection->prepare("SELECT * FROM product WHERE ean = :ean");
	$sth->execute(array(':ean' => $ean));
	
        return $sth->fetch(PDO::FETCH_OBJ);
    }
}
