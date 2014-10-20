<?php

namespace Kata\Homeworks\H04Velocity;


class Condition
{
    protected $limit;
    protected $counter;
    
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
