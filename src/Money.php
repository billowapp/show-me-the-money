<?php

namespace Billow\Utilities;

use Illuminate\Support\Facades\Config;
use NumberFormatter;

class Money
{
  protected $amount;
  protected $sub_unit = 100;
  protected $default_fraction_digits = 2;
  protected $currency_format = NumberFormatter::CURRENCY;

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
      round($this->sub_unit * round((float) $amount, $this->default_fraction_digits, PHP_ROUND_HALF_UP), 0, PHP_ROUND_HALF_UP)
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

  public function asCurrency($amount = null, $currencySymbol = 'ZAR')
  {
    if ($amount) $this->amount = $amount;
    return $this->getFormatter()->formatCurrency($amount, $currencySymbol);
  }

  public function newMoney(int $amount)
  {
    return new static($amount);
  }

  public function setCurrencyFormat($format): Money
  {
    $this->currency_format = $format;
    return $this;
  }

  public function getFormatter(): NumberFormatter
  {
    return (new NumberFormatter(
      Config::get('app.locale'),
      $this->currency_format
    ));
  }
}
