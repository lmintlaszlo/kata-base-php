<?php

namespace Kata\Homeworks\H07OneClick;

use Kata\Homeworks\H07OneClick\MappedData;
use Kata\Homeworks\H07OneClick\payment_manager;
use Kata\Homeworks\H07OneClick\Exceptions\InvalidMethodException;
use Kata\Homeworks\H07OneClick\Exceptions\InvalidParamsException;

class DataMapper
{
    private $method = null;
    private $params = null;
    private $mappedData;
    
    public function mapByObject(payment_manager $paymentManager)
    {
        $this->method = $paymentManager->getData('oneclick_method');
        $this->params = $paymentManager->getData('oneclick_params');

        $this->doMapping();

        return $this->mappedData;
    }
    
    public function mapByArray(array $array)
    {
        if (!empty($array[OneClick::PARAM_METHOD]))
        {
            $this->method = $array[OneClick::PARAM_METHOD];
        }
        
        if (!empty($array[OneClick::PARAM_PARAMS]))
        {
            $this->params = $array[OneClick::PARAM_PARAMS];
        }

        $this->doMapping();

        return $this->mappedData;
    }
    
    private function doMapping()
    {
        if (empty($this->method))
        {
            throw new InvalidMethodException();
        }
        
        if (empty($this->params))
        {
            throw new InvalidParamsException();
        }
        
        $this->mappedData = new MappedData($this->method, $this->params);
    }
}
