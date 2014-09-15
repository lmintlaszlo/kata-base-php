<?php

namespace Kata\Homeworks\H01IntSequence;

use Kata\Homeworks\H01IntSequence\InvalidIntegerException;

class IntSequence {

    /**
     * The sequecne.
     *
     * @var array
     */
    private $sequence;

    /**
     * Constructor. Sets the sequence.
     *
     * @param $sequence
     * @throws InvalidIntegerException
     */
    public function __construct($sequence)
    {
        if(!is_array($sequence))
        {
            throw new \InvalidArgumentException;
        }

        foreach ($sequence as $integer)
        {
            if(!is_int($integer))
            {
                throw new InvalidIntegerException();
            }
        }

        $this->sequence = $sequence;
    }

    /**
     * Calculates the minimum of the sequence.
     *
     * @return int
     */
    public function calculateMin()
    {
        return min($this->sequence);
    }

    /**
     * Calculates the maximum of the sequence.
     *
     * @return int
     */
    public function calculateMax()
    {
        return max($this->sequence);
    }

    /**
     * Calculates the number of elements in the sequence.
     *
     * @return int
     */
    public function calculateQuantity()
    {
        return count($this->sequence);
    }

    /**
     * Calculates the average of the elements in the sequence.
     *
     * @return int
     */
    public function calculateAverage()
    {
        return (array_sum($this->sequence) / $this->calculateQuantity());
    }

    /** Getters */
    public function getSequence()
    {
        return $this->sequence;
    }

}

class xxx extends \Exception
{}
