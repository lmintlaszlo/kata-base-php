<?php

namespace Kata\Homeworks\H04Velocity;


class Counter
{
    protected $limit;
    protected $value;
    protected $tableName;
    
    private $connection;
    
    public function __construct($value, \PDO $connection)
    {
        $this->value      = $value;
        $this->connection = $connection;
    }
    
    /**
     * Megmondja, hogy a szamlalo elerte-e felso limitet.
     * 
     * @return boolean True ha igen egyebkent false
     */
    public function isLimitReached()
    {
        return ($this->getCount() >= $this->limit);
    }
    
    /**
     * Egyel noveli a szamlalo erteket.
     * 
     * @return void
     */
    public function increment()
    {
        // Tabla nevvel nem szabad ilyet tenni
        try
        {            
            $sql  = "INSERT INTO " . $this->tableName . " (`value`, `counter`) VALUES (:value, 1)" .
                    "ON DUPLICATE KEY UPDATE `counter` = `counter` + 1";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':value', $this->value);

            $stmt->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    /**
     * A szamlalo erteket a maximalis ertekre allitja be.
     * 
     * @return void
     */
    public function setToMax()
    {
        // Tabla nevvel nem szabad ilyet tenni
        try
        {            
            $sql  = "INSERT INTO " . $this->tableName . " (`value`, `counter`) VALUES (:value, :counter)" .
                    "ON DUPLICATE KEY UPDATE `counter` = :counter";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':value', $this->value);
            $stmt->bindParam(':counter', $this->limit);

            $stmt->execute();
        
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    
    /**
     * Visszaadja a szamlalo eppen aktualis erteket.
     * 
     * @return int
     */
    public function getCount()
    {
        // Tabla nevvel nem szabad ilyet tenni
        try
        {    
            $sql  = "SELECT `counter` FROM " . $this->tableName . 
                    " WHERE `value` = :value";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':value', $this->value);

            $stmt->execute();
            
            $result = $stmt->fetch();
            
            return $result['counter'];
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
