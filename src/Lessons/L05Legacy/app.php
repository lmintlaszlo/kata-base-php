<?php

/**
 * @todo 
 *  - kommentelni a methodokat
 *  - nem letezokkel valo foglalkozás dobjon exception-t
 */

/**
 * my app
 */

use Kata\Lessons\L05Legacy\Product;
use Kata\Lessons\L05Legacy\ProductDao;

define('PRODUCTION_DATABASE_FILE', './product.db');

require_once("Product.php");
require_once("ProductException.php");
require_once("ProductDao.php");
require_once("NullProduct.php");


try
{

    $app = new App();
    $app->run();
}
catch (\Exception $e) {
    echo "Exception: " . $e->getMessage()."\n";
}



class App
{
    /** Db location */
    const PRODUCTION_DATABASE_FILE = './product.db';

    /** Properties of chicken product */
    const PRODUCT_CHICKEN_EAN  = '1234';
    const PRODUCT_CHICKEN_NAME = 'Chicken';
    
    /** Properties of turkey product */
    const PRODUCT_TURKEY_EAN  = '878789';
    const PRODUCT_TURKEY_NAME = 'Turkey';
    
    /** Properties of new turkey product */
    const PRODUCT_TURKEY_NEW_EAN  = '999';
    const PRODUCT_TURKEY_NEW_NAME = 'Modified turkey';
    
    /**
     * Contains a PDO connection.
     * 
     * @var null | PDO 
     */
    private $productDao = null;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initProductDao();
    }
    
    /**
     * Business logic.
     */
    public function run()
    {
        // Create chicken and turkey
        $this->createProducts();        
        $this->modifyTurkey();
        $this->showModifiedTurkey();
        $this->showProductsById();
        $this->deleteProduct();
        $this->showNullProduct();        
    }
    
    /**
     * Initialization of the DAO.
     */
    private function initProductDao()
    {
        if(empty($this->productDao))
        {
            $pdo = new PDO("sqlite:".self::PRODUCTION_DATABASE_FILE);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $this->productDao = new ProductDao($pdo);
        }
    }
    
    
    /**
     * Creates a new product.
     * 
     * @param string $ean   The ean of the new product
     * @param string $name  The name of the new product
     * 
     * @return Product  The created product
     */
    private function newProduct($ean, $name)
    {
        $product = new Product();
        $product->ean  = $ean;
        $product->name = $name;
        
        return $product;
    }
    
    /**
     * Creates chicken and turkey products.
     */
    private function createProducts()
    {
        $chicken = $this->newProduct(self::PRODUCT_CHICKEN_EAN, self::PRODUCT_CHICKEN_NAME);
        $turkey  = $this->newProduct(self::PRODUCT_TURKEY_EAN, self::PRODUCT_TURKEY_NAME);
        
        try
        {
            $isChickenCreated = $this->productDao->create($chicken);
            $isTurkeyCreated  = $this->productDao->create($turkey);

            echo self::PRODUCT_CHICKEN_NAME . ' created ' . 
                    (($isChickenCreated) ? '' : 'un') .
                    'successfuly!' . PHP_EOL;

            echo self::PRODUCT_TURKEY_NAME . ' created ' . 
                    (($isTurkeyCreated) ? ''  : 'un') . 
                    'successfuly!' . PHP_EOL;   
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
        
    }
    
    /**
     * Modifies the created turkey product.
     */
    private function modifyTurkey()
    {
        echo PHP_EOL;
        
        $turkeyToModify = $this->productDao->getByEan(self::PRODUCT_TURKEY_EAN);        
        $turkeyToModify->ean  = self::PRODUCT_TURKEY_NEW_EAN;
        $turkeyToModify->name = self::PRODUCT_TURKEY_NEW_NAME;
        
        try
        {
            $isTurkeyModified = $this->productDao->modify($turkeyToModify);

            echo self::PRODUCT_TURKEY_NAME . ' modified ' . 
                    (($isTurkeyModified)  ? '' : 'un') . 
                    'successfuly!' . PHP_EOL;            
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }

    }
    
    /**
     * Displays the modified turkey product.
     */
    private function showModifiedTurkey()
    {
        $modifiedTurkey = $this->productDao->getByEan(self::PRODUCT_TURKEY_NEW_EAN);
        
        echo PHP_EOL;
        echo self::PRODUCT_TURKEY_NAME . ' with modified data: ' . PHP_EOL;
        print_r($modifiedTurkey);
    }
    
    /**
     * Displays products by id.
     */
    private function showProductsById()
    {        
        $productNum1 = $this->productDao->getById(1);
        $productNum9 = $this->productDao->getById(9);
        
        echo PHP_EOL;
        echo 'Product with id 1: ' . PHP_EOL; print_r($productNum1);
        echo 'Product with id 9: ' . PHP_EOL; print_r($productNum9);
    }
    
    /**
     * Erases a product (which is not existing).
     */
    private function deleteProduct()
    {
        echo PHP_EOL;
        
        try
        {
            $productToDelete = $this->productDao->getByEan(self::PRODUCT_TURKEY_EAN);
            $resultOfDelete  = $this->productDao->delete($productToDelete);        

            echo 'Product with id: ' . $productToDelete->id . ' was deleted ' .
                    (($resultOfDelete) ? '' : 'un') .
                    'successfuly!' . PHP_EOL;            
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
    /**
     * Displays an empty product.
     */
    private function showNullProduct()
    {        
        $nullProduct = $this->productDao->getByEan(self::PRODUCT_TURKEY_EAN);
        
        echo PHP_EOL;
        echo 'Product with ean ' . self::PRODUCT_TURKEY_EAN . ': ' . PHP_EOL;
        print_r($nullProduct);
    }
}