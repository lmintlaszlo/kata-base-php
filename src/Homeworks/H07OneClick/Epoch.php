<?php

namespace Kata\Homeworks\H07OneClick;

class Epoch implements OneClick
{
    const REQUIRED_USERNAME          = 'username';
    const REQUIRED_REFERENCE_PI_CODE = 'reference_pi_code';
    const REQUIRED_VALAMI            = 'valami';
    
    private $requiredParams = array(
        self::REQUIRED_USERNAME,
        self::REQUIRED_REFERENCE_PI_CODE,
        self::REQUIRED_VALAMI,
    );
    
    public function getRequiredParams()
    {
        return $this->requiredParams;
    }

}
