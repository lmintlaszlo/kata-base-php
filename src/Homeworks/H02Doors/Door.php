<?php

namespace Kata\Homeworks\H02Doors;

use Kata\Homeworks\H01IntSequence\InvalidIntegerException;
use Kata\Lessons\L01Number\Number;

class Door
{
    /** The possible states of the door */
    const STATE_CLOSED = false;
    const STATE_OPENED = true;

    private $number;
    private $state;

    public function __construct($number)
    {
        if (!is_int($number))
        {
            throw new InvalidIntegerException();
        }

        $this->state  = self::STATE_CLOSED;
        $this->number = $number;
    }

    /**
     * Switches the state of the door.
     */
    public function toggle()
    {
        $this->state = ($this->state === self::STATE_CLOSED)
            ? self::STATE_OPENED
            : self::STATE_CLOSED;
    }

    /**
     * Tells the final state of the door without the need of walking through them.
     * @return bool
     */
    public function getFinalState()
    {
        /** @todo: Dependency injection */
        $number = new Number($this->number);
        return ($number->getNumberOfDividers() % 2 == 0)
            ? self::STATE_CLOSED
            : self::STATE_OPENED;
    }

    /**
     * Return the number of the door.
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Return the state of the door.
     *
     * @return bool
     */
    public function getState()
    {
        return $this->state;
    }

}