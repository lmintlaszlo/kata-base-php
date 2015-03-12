<?php

namespace Kata\Homeworks\H07OneClick;

use Kata\Homeworks\H07OneClick\OneClick;
use Kata\Homeworks\H07OneClick\Exceptions\InvalidMethodException;

class Factory
{
    public function getOneClickObject($method, MappedData $mappedData)
    {
        switch ($method)
        {
            case OneClick::METHOD_EPOCH:
                $oneClickObject = new Epoch($mappedData);
                break;

            case OneClick::METHOD_CCBILL:
                $oneClickObject = new Ccbill($mappedData);
                break;

            default: 
                throw new InvalidMethodException();
        }

        return $oneClickObject;
    }
}
