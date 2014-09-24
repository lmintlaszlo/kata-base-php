<?php

namespace Kata\Homeworks\H02Doors;


class DoorToggler
{
    private $doors = array();

    public function __construct()
    {
        $this->initializeDoors();
    }

    public function walkDoors()
    {
        for($i = 1; $i < 101; $i++)
        {
            foreach ($this->doors as $door)
            {
                if ($door->getNumber() % $i == 0)
                {
                    $door->toggle();
                }
            }
        }
    }

    public function getDoors()
    {
        return $this->doors;
    }

    public function getDoorStateByNumber($number)
    {
        return $this->doors[$number]->getState();
    }

    private function initializeDoors()
    {
        for($i=1; $i <= 100; $i++)
        {
            $this->doors[$i] = new Door($i);
        }
    }
}
