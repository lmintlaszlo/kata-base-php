<?php

namespace Kata\Homeworks\H04Velocity;


class Condition
{
    protected $limit = 100;
    protected $counter;
    
    /**
     * Sets the counter.
     * 
     * @param int $counter
     */
    public function setCounter($counter)
    {
        $this->counter = (int)$counter;
    }
    
    /**
     * Returns the counter.
     * 
     * @return int
     */
    public function getCounter()
    {
        // nem fog kelleni
        return $this->counter;
    }
    
    /**
     * Returns the counter.
     * 
     * @return int
     */
    public function getLimit()
    {
        // nem fog kelleni
        return $this->limit;
    }
    
    /**
     * Tells if the condition has reached its limit.
     * 
     * @return boolean True if reached false otherwise
     */
    public function isLimitReached()
    {
        return ($this->counter >= $this->limit);
    }   
}
