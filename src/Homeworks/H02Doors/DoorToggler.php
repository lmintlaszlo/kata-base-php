<?php

namespace Kata\Homeworks\H02Doors;

class DoorToggler
{
    CONST NUMBER_OF_DOORS = 100;
    CONST NUMBER_OF_WALKS = 100;

    private $doors = array();

    public function __construct()
    {
        $this->initializeDoors();
    }

    /**
     * Simulates the door openings and closings.
     */
    public function walkDoors()
    {
        for($i = 1; $i <= self::NUMBER_OF_WALKS; $i++)
        {
            foreach ($this->doors as $door)
            {
                if ($door->getNumber() % $i === 0)
                {
                    $door->toggle();
                }
            }
        }
    }

    /**
     * Tells the state of the given door.
     *
     * @param int $number  The number of the door which's state is the question
     *
     * @return boolean  False if the door is closed and true otherwise
     */
    public function getDoorStateByNumber($number)
    {
        return $this->doors[$number]->getState();
    }

    /**
     * Inicialises the doors.
     */
    private function initializeDoors()
    {
        for($i=1; $i <= self::NUMBER_OF_DOORS; $i++)
        {
            $this->doors[$i] = new Door($i);
        }
    }
}
