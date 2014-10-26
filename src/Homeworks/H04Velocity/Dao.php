<?php

namespace Kata\Homeworks\H04Velocity;

class Dao
{
    protected $connection;
    
    /**
     * Beallitja az osztaly altal hasznalt kapcsolatot.
     * 
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

}
