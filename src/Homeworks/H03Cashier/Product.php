<?php

namespace Kata\Homeworks\H03Cashier;

abstract class Product
{
    /** Discount types */
    const DISCOUNT_PRICE   = 'cheaperProduct';
    const DISCOUNT_PIECE   = 'extraProduct';

    /** Amount types */
    const AMOUNT_KG    = 'kg';
    const AMOUNT_YEAR  = 'year';
    const AMOUNT_PIECE = 'piece';

    protected $name;
    protected $price;
    protected $amount;
    protected $amountUnit;
    protected $discount;

    public function __construct($amount = 1, Discount $discount = null)
    {
        $this->amount   = $amount;
        $this->discount = $discount;
    }
    
    /**
     * Tells what price should the cashier use for count.
     * 
     * @return int
     */
    public function getPriceForCashier()
    {
        if ($this->isDiscountGranted() && $this->getDiscount() instanceof DiscountPrice)
        {
            return $this->getDiscount()->getValue();
        }
        
        return $this->price;
    }
    
    /**
     * Tells what amount should the cashier use for count.
     * 
     * @return int
     */
    public function getAmountForCashier()
    {
        if ($this->isDiscountGranted() && $this->getDiscount() instanceof DiscountPiece)
        {
            $free = (int)($this->getAmount() / ($this->getDiscount()->getMinimumAmount() + $this->getDiscount()->getValue()));
            return ($this->getAmount() - $free);
        }
        
        return $this->getAmount();
    }

    /**
     * Tells if there is a discount available for the product.
     *
     * @return bool
     */
    private function isDiscountAvailable()
    {
        return !($this->getDiscount() instanceof DiscountNone);
    }

    /**
     * Tells if the discount limit is reached.
     *
     * @return bool
     */
    private function isDiscountLimitReached()
    {
        return ($this->getAmount() >= $this->getDiscount()->getMinimumAmount());
    }    
    
    /**
     * Tells if the discount can be applied to the product.
     * 
     * @return bool
     */
    private function isDiscountGranted()
    {
        return ($this->isDiscountAvailable() && $this->isDiscountLimitReached());
    }
    

    /** Getters */
    public function getName()
    {
        return $this->name;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getDiscount()
    {
        return $this->discount;
    }
    
    /** Setters */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }
}
