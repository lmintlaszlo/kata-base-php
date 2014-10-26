<?php

namespace Kata\Homeworks\H04Velocity\Counter;

use Kata\Homeworks\H04Velocity\Counter;


class Ip extends Counter
{
    protected $limit     = 3;
    protected $tableName = 'ip';
}
