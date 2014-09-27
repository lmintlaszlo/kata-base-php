<?php
/**
 * Created by PhpStorm.
 * User: schumann
 * Date: 2014.09.27.
 * Time: 23:56
 */

namespace Kata\Homeworks\H03Cashier;


class Apple extends Product
{
    protected $name                 = 'Apple';
    protected $price                = 32;
    protected $amountUnit           = self::AMOUNT_KG;
    protected $minAmountForDiscount = 5;
    protected $discountType         = self::DISCOUNT_CHEAPER;
    protected $discountValue        = 25;

} 