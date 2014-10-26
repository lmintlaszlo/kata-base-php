<?php

namespace Kata\Homeworks\H04Velocity;

use Kata\Homeworks\H04Velocity\Dao\CounterDao;


abstract class Counter extends CounterDao
{    
    protected $limit;
    protected $value;
    
    public function __construct($value, \PDO $connection)
    {
        $this->value = $value;
        parent::__construct($connection, $this->tableName);
    }
    
    /**
     * Megmondja, hogy a szamlalo elerte-e felso limitet.
     * 
     * @return boolean True ha igen egyebkent false
     */
    public function isLimitReached()
    {
        return ($this->getCount($this->value) >= $this->limit);
    }    
    
    /**
     * Egyel noveli a szamlalo erteket.
     * 
     * @return boolean
     */
    public function increment()
    {
        return $this->incrementByValue($this->value);
    }

    /**
     * A szamlalo erteket a maximalis ertekre allitja be.
     * 
     * @return boolean
     */
    public function setToLimit()
    {
        return $this->setToLimitByValue($this->value, $this->limit);
    }

    /**
     * Visszaadja a szamlalo eppen aktualis erteket.
     * 
     * @return int
     */
    public function getCount()
    {
        return $this->getCountByValue($this->value);
    }
}
