<?php

namespace Kata\Homeworks\H07OneClick;

class Ccbill implements OneClick
{
    const REQUIRED_SUBSCRIPTION_ID = 'subscription_id';
    
    private $requiredParams = array(
        self::REQUIRED_SUBSCRIPTION_ID,
    );
    
    public function getRequiredParams()
    {
        return $this->requiredParams;
    }

}
