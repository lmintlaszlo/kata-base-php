<?php

namespace Kata\Homeworks\H03Cashier;

abstract class Product
{
    /** Discount types */
    const DISCOUNT_PRICE = 'cheaperProduct';
    const DISCOUNT_EXTRA   = 'extraProduct';

    /** Amount types */
    const AMOUNT_KG    = 'kg';
    const AMOUNT_YEAR  = 'year';
    const AMOUNT_PIECE = 'piece';

    protected $name;
    protected $price;
    protected $amount;
    protected $amountUnit;
    protected $minAmountForDiscount;
    protected $discountType;
    protected $discountValue;

    public function __construct($amount = 1)
    {
        $this->amount = $amount;
    }

    /**
     * Tells if there is a discount available for the product.
     *
     * @return bool
     */
    public function isDiscountAvailable()
    {
        return ($this->minAmountForDiscount !== null);
    }

    /**
     * Tells if the discount limit is reached.
     *
     * @return bool
     */
    public function isDiscountLimitReached()
    {
        return ($this->getAmount() >= $this->getMinAmountForDiscount());
    }
    
    /** Getters */
    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getAmountUnit()
    {
        return $this->amountUnit;
    }

    public function getMinAmountForDiscount()
    {
        return $this->minAmountForDiscount;
    }

    public function getDiscountType()
    {
        return $this->discountType;
    }

    public function getDiscountValue()
    {
        return $this->discountValue;
    }

    /** Setters */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }
} 