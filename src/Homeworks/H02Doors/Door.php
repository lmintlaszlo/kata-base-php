<?php

namespace Kata\Homeworks\H02Doors;

use Kata\Homeworks\H01IntSequence\InvalidIntegerException;
use Kata\Lessons\L01PrimeFactors\PrimeFactors;

class Door
{
    const STATE_CLOSED = false;
    const STATE_OPENED = true;

    private $number;
    private $numberOfDividers = 1;
    private $numberOfToggles  = 0;
    private $state;
    private $finalState;

    public function __construct($number)
    {
        if (!is_int($number))
        {
            throw new InvalidIntegerException();
        }

        $this->state  = self::STATE_CLOSED;
        $this->number = $number;

        $this->calculateNumberOfDividers();
        $this->calculateFinalState();
    }

    public function toggle()
    {
        $this->state = ($this->state === self::STATE_CLOSED)
            ? $this->state = self::STATE_OPENED
            : self::STATE_CLOSED;
        $this->numberOfToggles++;
    }

    public function getNumberOfToggles()
    {
        return $this->numberOfToggles;
    }

    public function getFinalState()
    {
        return $this->finalState;
    }

    public function getNumberOfDividers()
    {
        return $this->numberOfDividers;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getState()
    {
        return $this->state;
    }

    private function calculateFinalState()
    {
        if ($this->numberOfDividers % 2 == 0)
        {
            $this->finalState = self::STATE_CLOSED;
        }

        $this->finalState = self::STATE_OPENED;

    }

    private function calculateNumberOfDividers()
    {
        $primeFactorizer  = new PrimeFactors();
        $primeFactors     = $primeFactorizer->getPrimeFactors($this->number);

        $numberOfEachPrime = array_count_values($primeFactors);

        foreach($numberOfEachPrime as $base => $power)
        {
            $this->numberOfDividers = ($this->numberOfDividers * ($power+1));
        }
    }

}