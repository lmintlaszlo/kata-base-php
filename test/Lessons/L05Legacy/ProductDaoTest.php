<?php

use Kata\Lessons\L05Legacy\Product;
use Kata\Lessons\L05Legacy\NullProduct;
use Kata\Lessons\L05Legacy\ProductDao;


class ProductDaoTest extends PHPUnit_Framework_TestCase
{
    const TEST_DATABASE_FILE = 'product.db';
    
    private static $connection;
    
    private $productDao;
    
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
    }
    
    
    /**
     * Testing the getByEan method for receiving NullProduct.
     */
    public function testGetByEanNullProduct()
    {
        $notExistingEan = '011110';
        
        $this->directDeleteByEan($notExistingEan);
        
        $product = $this->productDao->getByEan($notExistingEan);
                
        $this->assertInstanceOf('\Kata\Lessons\L05Legacy\NullProduct', $product);        
    }
    
    /**
     * Testing the getByEan method for receiving Product.
     */
    public function testGetByEanProduct()
    {
        $newEan  = '011110';
        $newName = 'Test';
        
        $this->directDeleteByEan($newEan);
        $this->directInsert($newEan, $newName);
                
        $product = $this->productDao->getByEan($newEan);
                
        $this->assertInstanceOf('\Kata\Lessons\L05Legacy\Product', $product);        
        $this->assertEquals($newEan, $product->ean);        
        $this->assertEquals($newName, $product->name);        
    }
    
    /**
     * Testing the getById method for receiving NullProduct.
     */
    public function testGetByIdNullProduct()
    {
        $notExistingId = 1000;
        
        $this->directDeleteById($notExistingId);
        
        $product = $this->productDao->getById($notExistingId);
                
        $this->assertInstanceOf('\Kata\Lessons\L05Legacy\NullProduct', $product);        
    }
    
    /**
     * Testing the getById method for receiving Product.
     */
    public function testGetByIdProduct()
    {
        $newEan  = '011110';
        $newName = 'Test';
        
        $this->directDeleteByEan($newEan);
        
        $insertId = $this->directInsert($newEan, $newName);
        
        $product = $this->productDao->getById($insertId);
                
        $this->assertInstanceOf('\Kata\Lessons\L05Legacy\Product', $product);        
        $this->assertEquals($newEan, $product->ean);        
        $this->assertEquals($newName, $product->name);        
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
        $newEan  = '011110';
        $newName = 'Test';
        
        $this->directDeleteByEan($newEan);
        
        $newProduct = new Product();
        $newProduct->ean  = $newEan;
        $newProduct->name = $newName;
        
        $this->assertTrue($this->productDao->create($newProduct));
    }
    
    /**
     * Testing the create method with not uniq EAN.
     */
    public function testCreateNotUniq()
    {
        $newEan  = '011110';
        $newName = 'Test';
        
        $this->directDeleteByEan($newEan);
        $this->directInsert($newEan, $newName);
        
        $newProduct = new Product();
        $newProduct->ean  = $newEan;
        $newProduct->name = $newName;
        
        $this->assertFalse($this->productDao->create($newProduct));
    }
    
    /**
     * Testing the modify method with ProductIsNullException.
     * 
     * @expectedException \Kata\Lessons\L05Legacy\ProductIsNullException
     */
    public function testModifyWithIsNullException()
    {
        $product = new NullProduct();
        
        $this->productDao->modify($product);
    }
    
    /**
     * Testing the modify method with ProductMissingIdException.
     * 
     * @expectedException \Kata\Lessons\L05Legacy\ProductMissingIdException
     */
    public function testModifyWithMissingIdException()
    {
        $newEan  = '011110';
        $newName = 'Test';
        $newEanForModification = '0115110';
        
        $this->directDeleteByEans(array($newEan, $newEanForModification));       
        $this->directInsert($newEan, $newName);
        
        $newProduct = new Product();
        $newProduct->id   = null;
        $newProduct->ean  = $newEanForModification;
        $newProduct->name = $newName;
        
        $this->productDao->modify($newProduct);
    }
    
    /**
     * Testing the modify method with uniq EAN. 
     */
    public function testModifyUniq()
    {
        $newEan  = '011110';
        $newName = 'Test';
        $newEanForModification = '0115110';
        
        $this->directDeleteByEans(array($newEan, $newEanForModification));        
        $insertId = $this->directInsert($newEan, $newName);
        
        
        $newProduct = new Product();
        $newProduct->id   = $insertId;
        $newProduct->ean  = $newEanForModification;
        $newProduct->name = $newName;
        
        
        $this->assertTrue($this->productDao->modify($newProduct));
    }
    
    /**
     * Testing the modify method with not uniq EAN.
     */
    public function testModifyNotUniq()
    {
        $newEan  = '011110';
        $newName = 'Test';
        
        $this->directDeleteByEan($newEan);
        $insertId = $this->directInsert($newEan, $newName);        
        
        $newProduct = new Product();
        $newProduct->id   = $insertId;
        $newProduct->ean  = $newEan;
        $newProduct->name = $newName;
        
        $this->assertFalse($this->productDao->modify($newProduct));
    }
    
    /**
     * Testing the delete method with ProductIsNullException.
     * 
     * @expectedException \Kata\Lessons\L05Legacy\ProductIsNullException
     */
    public function testDeleteWithIsNullException()
    {
        $product = new NullProduct();
        
        $this->productDao->delete($product);
    }
    
    /**
     * Testing the delete method with ProductMissingIdException.
     * 
     * @expectedException \Kata\Lessons\L05Legacy\ProductMissingIdException
     */
    public function testDeleteWithMissingIdException()
    {
        $newEan  = '011110';
        $newName = 'Test';
        
        $this->directDeleteByEan($newEan);
        $this->directInsert($newEan, $newName);
        
        $product = new Product();
        $product->id   = null;
        $product->ean  = $newEan;
        $product->name = $newName;
        
        $this->assertTrue($this->productDao->delete($product));
    }
    
    /**
     * Testing the delete method.
     */
    public function testDelete()
    {
        $newEan  = '011110';
        $newName = 'Test';
        
        $this->directDeleteByEan($newEan);
        $insertId = $this->directInsert($newEan, $newName);
        
        $product = new Product();
        $product->id   = $insertId;
        $product->ean  = $newEan;
        $product->name = $newName;
        
        $this->assertTrue($this->productDao->delete($product));
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
     * Deletes by multiple EANs.
     * 
     * @param array $eans  EANs to be deleted
     */
    private function directDeleteByEans(array $eans)
    {
        foreach($eans as $ean)
        {
            $this->directDeleteByEan($ean);
        }
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
}
