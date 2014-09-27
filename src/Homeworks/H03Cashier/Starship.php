<?php
/**
 * Created by PhpStorm.
 * User: schumann
 * Date: 2014.09.27.
 * Time: 23:56
 */

namespace Kata\Homeworks\H03Cashier;


class Starship extends Product
{
    protected $name                 = 'Starship';
    protected $price                = 999.99;
    protected $amountUnit           = self::AMOUNT_PIECE;
    protected $minAmountForDiscount = 2;
    protected $discountType         = self::DISCOUNT_EXTRA;
    protected $discountValue        = 1;

} 