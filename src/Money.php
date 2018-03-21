<?php
namespace Billow\Utilities;

/*
 * Author Warren Hansen
 * Basic Money Class
 */

class Money
{
    protected $amount;
    protected $sub_unit = 100;
    protected $default_fraction_digits = 2;

    public function __construct($amount = 0)
    {
        $this->amount = $amount;
    }

    /*
     * Create new Money Object from a string value
     * @param $amount
     * return static
     */
    public function fromString($amount = 0)
    {
        return new static(intval(
            round($this->sub_unit * round((string) $amount, $this->default_fraction_digits, PHP_ROUND_HALF_UP), 0, PHP_ROUND_HALF_UP)
        ));
    }

    public function amount()
    {
        return intval($this->amount);
    }

    public function convertedAmount($amount = null)
    {
        if ($amount) $this->amount = $amount;

        return round($this->amount / $this->sub_unit, $this->default_fraction_digits);
    }

    public function asCurrency($amount = null, $currencySymbol = 'R')
    {
        if ($amount) $this->amount = $amount;
        return money_format($currencySymbol . ' %i', $this->convertedAmount());
    }

    public function newMoney(int $amount)
    {
        return new static($amount);
    }
}
