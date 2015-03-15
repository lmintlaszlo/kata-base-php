<?php

namespace Kata\Homeworks\H07String2Array;

use Kata\Homeworks\H07String2Array\Exceptions\InvalidStringException;

class String2Array
{
    const DELIMITER_COLUMN = ",";
    
    public function stringToArray($string)
    {
        if (!is_string($string))
        {
            throw new InvalidStringException();
        }

        return explode(self::DELIMITER_COLUMN, $string);
    }
}
