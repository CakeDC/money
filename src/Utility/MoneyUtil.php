<?php

namespace CakeDC\Accounting\Utility;

use Cake\Error\Debugger;
use CakeDC\Accounting\Database\Type\MoneyType;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;

class MoneyUtil
{
    /**
     * Returns a new object of type Money
     *
     * @param int|float|string $value
     * @param boolean $fromDb
     * @return Money
     */
    public static function money($value, $fromDb = false) : ?Money
    {
        if (!is_numeric($value) && empty($value)) {
            return null;
        }
        if ($value instanceof Money) {
            return $value;
        }

        if (!$fromDb) {
            $parts = explode('.', $value );

            if (!isset($parts[1])) {
                $parts[1] = '00';
            }
            $decimalLength = strlen($parts[1] ?? '') ;

            if ($decimalLength == 1) {
                $parts[1] = $parts[1] . '0';
            }

            $value = ltrim($parts[0] . $parts[1], '0');
        }

        return Money::USD(!empty($value) ? str_replace(',', '', $value) : 0);
    }

    /**
     * @param Money $money
     * @return float
     */
    public static function float(Money $money) : float
    {
        return $money->getAmount() / 100;
    }

    /**
     * @param Money $value
     * @return string
     */
    public static function format(Money $value) : string
    {
        /** @var Money $value */
        $currencies = new ISOCurrencies();

        $numberFormatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

        return $moneyFormatter->format($value); // outputs $1.00
    }

    public static function zero() : Money
    {
        return self::money(0);
    }

    public static function greaterThanZero(Money $amount) : bool
    {
        return $amount->greaterThan(self::zero());
    }

    public static function greaterThanOrEqualZero(Money $amount) : bool
    {
        return $amount->greaterThanOrEqual(self::zero());
    }

    public static function lessThanZero(Money $amount) : bool
    {
        return $amount->lessThan(self::zero());
    }

    public static function lessThanOrEqualZero(Money $amount) : bool
    {
        return $amount->lessThanOrEqual(self::zero());
    }

    public static function equalZero(Money $amount) : bool
    {
        return $amount->equals(self::zero());
    }

}
