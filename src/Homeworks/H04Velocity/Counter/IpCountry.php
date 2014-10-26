<?php

namespace Kata\Homeworks\H04Velocity\Counter;

use Kata\Homeworks\H04Velocity\Counter;

class IpCountry extends Counter
{
    protected $limit     = 1000;
    protected $tableName = 'ip_country';
    
}
