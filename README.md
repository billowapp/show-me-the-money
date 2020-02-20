# Show-me-the-money

Super slim Money class.

### Facade

```php
[
	'Money' => Billow\Utilities\Facades\Money::class,
];
```

### Usage

```php
[
	$money = new Money(10000);
	$money->amount() // 10000
	$money->convertedAmount() // '100.00'
	$money->fromString('100') // 10000
	$money->fromString('100')->amount() // 10000
	$money->fromString('100')->convertedAmount() // '100.00'
	$money->fromString('100')->asCurrency('R') // 'R 100.00'
];
```
