<?php

namespace Kata\Homeworks\H01IntSequence;

class IntSequence {

    private $sequence;

    public function __construct($sequence)
    {
        if(!is_array($sequence))
        {
            throw new \InvalidArgumentException;
        }

        foreach ($sequence as $integer)
        {
            if(intval($integer) !== $integer)
            {
                throw new InvalidIntegerException();
            }
        }

        $this->sequence = $sequence;
    }

    public function calculateMin()
    {

    }

    /** Getters */
    public function getSequence()
    {
        return $this->sequence;
    }

} 