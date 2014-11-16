<?php

namespace Kata\Lessons\L05Legacy;

/**
 * Class ProductDao
 */
class ProductDao {

    /**
     * @var \PDO Database resource.
     */
    private $pdo;
    
    public function __construct(\Pdo $pdo)
    {
        $this->pdo = $pdo;
    }    

    /**
     * Get product by EAN.
     *
     * @param $ean
     * @return NullProduct|Product
     */
    public function getByEan($ean)
    {
	$sth = $this->pdo->prepare("SELECT * FROM product WHERE ean = :ean");
	$sth->execute(array(':ean' => $ean));

	$rows = $sth->fetchAll();
	if (count($rows) > 0)
	{
	    $row = $rows[0];

	    $product = new Product;
	    $product->id = $row['id'];
	    $product->name = $row['name'];
	    $product->ean = $row['ean'];

	    return $product;
	}

	return new NullProduct();
    }

    /**
     * Get product by id.
     *
     * @param $id
     * @return NullProduct|Product
     */
    public function getById($id)
    {
	$sth = $this->pdo->prepare("SELECT * FROM product WHERE id = :id");
	$sth->execute(
	    array(
		':id' => $id,
	    )
	);

	$rows = $sth->fetchAll();
	if (count($rows) > 0)
	{
	    $row = $rows[0];

	    $product = new Product;
	    $product->id = $row['id'];
	    $product->name = $row['name'];
	    $product->ean = $row['ean'];

	    return $product;
	}

	return new NullProduct;
    }

    /**
     * Create product in database if the EAN is not existing.
     *
     * @param Product $product  Product to be created
     * 
     * @return boolean
     * 
     * @throws ProductException
     */
    public function create(Product $product)
    {
        $this->checkNullProduct($product, 'create');

	if (self::checkUnique($product->ean))
	{
	    $sth = $this->pdo->prepare("
		INSERT INTO product (ean, name) VALUES (:ean, :name)
	    ");

	    $sth->execute(array(
		    ':ean' => $product->ean,
		    ':name' => $product->name,
            ));
            
	    return true;
	}
        
        return false;
    }

    /**
     * Modify the product name and ean in database by id.
     * It checks if the EAN already exists by another product, and does not overwrite.
     *
     * @param Product $product  Product to be modified
     * 
     * @return boolean
     * 
     * @throws ProductException
     */
    public function modify(Product $product)
    {
        $this->checkNullProduct($product, 'modify');
        $this->checkId($product);

        $previousProduct = $this->getById($product->id);
        $eanNotChanged   = ($previousProduct->ean == $product->ean);
        
        if ($eanNotChanged || self::checkUnique($product->ean))
	{
	    $sth = $this->pdo->prepare("
		UPDATE product
		SET
		    ean = :ean,
		    name = :name
		WHERE id = :id
	    ");

	    return $sth->execute(array(
                ':id'   => $product->id,
                ':ean'  => $product->ean,
                ':name' => $product->name,
            ));
	}
        
	return false;
    }

    /**
     * Delete product from database
     *
     * @param Product $product
     * 
     * @return boolean
     * 
     * @throws ProductException
     */
    public function delete(Product $product)
    {
        $this->checkNullProduct($product, 'delete');
        $this->checkId($product);
        
        $sth = $this->pdo->prepare("DELETE FROM product WHERE id = :id");
        $sth->execute(array(':id' => $product->id));

	return true;
    }

    /**
     * Check if the product will be unique by EAN
     *
     * @param string $ean  The ean to validate
     * 
     * @return boolean
     */
    private function checkUnique($ean)
    {        
	$sth = $this->pdo->prepare("SELECT count(*) AS `sum` FROM product WHERE ean = :ean");
	$sth->execute(array(':ean' => $ean));

	$countRow = $sth->fetch();
        
        return ($countRow['sum'] == 0);
    }
    
    /**
     * Check if a product is NullProduct.
     * 
     * @param Product $product  Product to check
     * @param string  $action   Action to be done with the product
     * 
     * @throws ProductException
     */
    private function checkNullProduct(Product $product, $action)
    {
        if ($product instanceof NullProduct)
        {
            throw new ProductIsNullException('Can not ' . $action . ' not existing product!');
        }
    }
    
    private function checkId(Product $product)
    {
        if(empty($product->id))
        {
            throw new ProductMissingIdException('Id of product must be set!');
        }
    }
}