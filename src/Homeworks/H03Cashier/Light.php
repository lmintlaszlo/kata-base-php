<?php
/**
 * Created by PhpStorm.
 * User: schumann
 * Date: 2014.09.27.
 * Time: 23:56
 */

namespace Kata\Homeworks\H03Cashier;


class Light extends Product
{
    protected $name       = 'Light';
    protected $price      = 15;
    protected $amountUnit = self::AMOUNT_YEAR;

} 