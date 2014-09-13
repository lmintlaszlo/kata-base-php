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

        $this->sequence = $sequence;
    }

    /** Getters */
    public function getSequence()
    {
        return $this->sequence;
    }

} 