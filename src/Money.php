<?php
namespace Billow\Utilities;

/*
 * Author Warren Hansen  
 * Basic Money Class
*/

class Money
{
	protected $amount;
	protected $currency_symbol = 'R';
	protected $sub_unit = 100;
	protected $default_fraction_digits = 2;

	public function __construct($amount = 0, string $currency_symbol = null)
	{
		if ($currency_symbol) $this->currency_symbol = $currency_symbol;
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
        		round($this->sub_unit * round((string)$amount, $this->default_fraction_digits, PHP_ROUND_HALF_UP ), 0, PHP_ROUND_HALF_UP)
            ));
	}

	public function amount()
	{
		return intval($this->amount);
	}

	public function convertedAmount($amount = null)
	{
		if($amount) $this->amount = $amount;
		return round($this->amount / $this->sub_unit, $this->default_fraction_digits);
	}

	public function asCurrency($amount = null)
	{
		if($amount) $this->amount = $amount;
		return money_format($this->currency_symbol.' %i', $this->convertedAmount());
	}
	
	public function add(int $amount)
    {
        $value = $this->amount + $amount;
        return $this->newMoney($value);
    }

    public function subtract(Money $other)
    {
        $value = $this->amount - $amount;
        return $this->newMoney($value);
    }

    public function newMoney(int $amount)
    {
    	return new static($amount);
    }
}