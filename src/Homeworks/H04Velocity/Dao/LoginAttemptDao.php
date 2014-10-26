<?php

namespace Kata\Homeworks\H04Velocity\Dao;

use Kata\Homeworks\H04Velocity\Dao;


class LoginAttemptDao extends Dao
{    
    /**
     * Felhasznalonev alapjan visszaadja az adott felhasznalohoz eltarolt 
     * osszes adatot.
     * 
     * @param string $username
     *  
     * @return array
     */
    public function getStoredPropertiesByUsername($username)
    {
        $sql  = "SELECT * FROM `login` WHERE `username` = :username";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    /**
     * Felhasznalonev alapjan visszaadja az adott felhasznalohoz eltarolt 
     * osszes adatot.
     * 
     * @todo Flag kene, ha nincs olyan kulcs, mert null-t egyebkent is adhat vissza.
     * 
     * @param string $username
     * @param string $property
     * 
     * @return mixed
     */
    public function getAStoredPropertyByUsername($username, $property)
    {
        $storedData = $this->getStoredPropertiesByUsername($username);
        
        if(!empty($property) && isset($storedData[$property]))
        {
            return $storedData[$property];
        }
        
        return null;
    }
    
    /**
     * Kiuriti a tablat.
     */
    public function resetTable()
    {
        $truncateSql = "TRUNCATE TABLE `login`";
        
        $truncateStatement = $this->connection->prepare($truncateSql);
        $truncateStatement->execute();
        
        
        $insertSql = "INSERT INTO `login` (`username`,`password`,`country`)" .
                     "VALUES ('pityu', 'pityu', 'hungary')";
        
        $insertStatement = $this->connection->prepare($insertSql);
        $insertStatement->execute();
    }
}
