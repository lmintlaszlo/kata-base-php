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
        $sql  = "INSERT INTO " . $this->tableName . " (`value`) VALUES (:value)" .
                "ON DUPLICATE KEY UPDATE `counter` = `counter` + 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':value', $value);

        return $stmt->execute();
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
        $sql  = "INSERT INTO " . $this->tableName . " (`value`, `counter`) VALUES (:value, :counter)" .
                "ON DUPLICATE KEY UPDATE `counter` = :counter";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':counter', $limit);

        return $stmt->execute();
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
        $sql  = "SELECT `counter` FROM " . $this->tableName . 
                " WHERE `value` = :value";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':value', $value);

        $x = $stmt->execute();

        $result = $stmt->fetch();

        return $result['counter'];
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
