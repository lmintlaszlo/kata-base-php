<?php

namespace Kata\Homeworks\H04Velocity\Dao;

use Kata\Homeworks\H04Velocity\Dao;


class CounterDao extends Dao
{
    private $tableName;

    /**
     * Beallitja az osztaly altal hasznalt kapcsolatot.
     * 
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection, $tableName)
    {
        $this->tableName = $tableName;
        
        parent::__construct($connection);
    }    

    /**
     * Egyel noveli a szamlalo erteket.
     * 
     * @param string  $value
     * 
     * @return boolean
     */
    public function incrementByValue($value)
    {
        try
        {            
            $sql  = "INSERT INTO " . $this->tableName . " (`value`) VALUES (:value)" .
                    "ON DUPLICATE KEY UPDATE `counter` = `counter` + 1";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':value', $value);
            $stmt->execute();
            
            return true;
        }
        catch (Exception $e)
        {
            return false;
        }
    }

    /**
     * A szamlalo erteket a maximalis ertekre allitja be.
     * 
     * @param string  $value
     * @param int     $limit
     * 
     * @return boolean
     */
    public function setToLimitByValue($value, $limit)
    {
        try
        {            
            $sql  = "INSERT INTO " . $this->tableName . " (`value`, `counter`) VALUES (:value, :counter)" .
                    "ON DUPLICATE KEY UPDATE `counter` = :counter";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':value', $value);
            $stmt->bindParam(':counter', $limit);

            $stmt->execute();
            
            return true;            
        }
        catch (Exception $e)
        {
            return false;
        }
    }

    /**
     * Visszaadja a szamlalo eppen aktualis erteket.
     * 
     * @param strig  $value
     * $this->resetTableByCounter();
     * @return int
     */
    public function getCountByValue($value)
    {
        try
        {    
            $sql  = "SELECT `counter` FROM " . $this->tableName . 
                    " WHERE `value` = :value";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':value', $value);

            $x = $stmt->execute();
            
            $result = $stmt->fetch();

            return $result['counter'];
            
        }
        catch (Exception $e)
        {
            return -1;
        }
    }
    
    /**
     * Kiuriti a tablat.
     */
    public function resetTable()
    {
        $truncateSql = "TRUNCATE TABLE `" . $this->tableName. "`";
        
        $truncateStatement = $this->connection->prepare($truncateSql);
        $truncateStatement->execute();
    }
}
