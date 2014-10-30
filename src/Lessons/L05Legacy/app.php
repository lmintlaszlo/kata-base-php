<?php

/**
 * my app
 */

use Kata\Lessons\L05Legacy\Product;
use Kata\Lessons\L05Legacy\ProductDao;

define('PRODUCTION_DATABASE_FILE', './product.db');

require_once("ProductDao.php");
require_once("Product.php");


try {
    
    $dsn = sprintf("sqlite:%s", PRODUCTION_DATABASE_FILE);
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    $productDao = new ProductDao($pdo);
    
    //- add my product
    $product = new Product();
    $product->ean = '1234';
    $product->name = 'Chicken';

    $result = $productDao->create($product);
    var_export($result);

    //- add my product - will delete
    $product2 = new Product();
    $product2->ean = '878789';
    $product2->name = 'Turkey';

    $result2 = $productDao->create($product2);
    var_export($result2);

//    $productToUpdate = ProductDao::getByEan('878789');
//    $productToUpdate->name = 'Updated product turkey';
//    $productToUpdate->ean = '9999';
//    $result = ProductDao::modify($productToUpdate);
//    var_export($result); 
//
//    $result = ProductDao::getByEan('9999');
//    var_export($result);
//
//    $result = ProductDao::getById(9);
//    var_export($result);
//
//    $result = ProductDao::getById(1);
//    var_export($result);
//
//    $productToDelete = ProductDao::getByEan('878789');
//    $result = ProductDao::delete($productToDelete);
//    var_export($result);
//
//    $result = ProductDao::getByEan('878789');
//    var_export($result);


}
catch (\Exception $e) {
    echo "Exception: " . $e->getMessage()."\n";
}



