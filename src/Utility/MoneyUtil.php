<?php
/**
 * Copyright 2021, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2021, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
namespace CakeDC\Money\Utility;

use Cake\Core\Configure;
use Cake\Error\Debugger;
use CakeDC\Accounting\Database\Type\MoneyType;
use Money\Currencies\BitcoinCurrencies;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\BitcoinMoneyFormatter;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Formatter\IntlMoneyFormatter;
use CakeDC\Money\Money;
use Money\MoneyFormatter;

/**
 * Class MoneyUtil
 *
 * Utility class to convert and operate money type
 *
 * @package CakeDC\Money\Utility
 */
class MoneyUtil
{
    /** @var MoneyFormatter */
    protected static $_moneyFormatters = [];

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
        /** @var Currency $currency */
        $currency = $value->getCurrency();

        return static::_loadMoneyFormatter($currency)->format($value->getMoney());
    }

    /**
     * Loads proper money formatter or returns if it is already loaded
     *
     * @param Currency $currency
     * @return MoneyFormatter
     */
    protected static function _loadMoneyFormatter(Currency $currency) : MoneyFormatter
    {
        if (isset(static::$_moneyFormatters[$currency->getCode()])) {
            return static::$_moneyFormatters[$currency->getCode()];
        }
        $iso = new ISOCurrencies();
        $bitcoin = new BitcoinCurrencies();
        if ($currency->isAvailableWithin($iso)) {
            $numberFormatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
            $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $iso);
        } elseif ($currency->isAvailableWithin($bitcoin)) {
            $moneyFormatter = new BitcoinMoneyFormatter(7, $bitcoin);
        } else {
            throw new \RuntimeException(sprintf('Cannot format currency \'%s\'. Only ISO currencies and Bitcoin are allowed.'));
        }
        static::$_moneyFormatters[$currency->getCode()] = $moneyFormatter;
        return static::$_moneyFormatters[$currency->getCode()];
    }

    /**
     * Returns money object with value 0.00, false otherwise.
     *
     * @return Money
     */
    public static function zero() : Money
    {
        return self::money(0);
    }

    /**
     * Returns true if amount value is > 0.00
     *
     * @param Money $amount
     * @return bool
     */
    public static function greaterThanZero(Money $amount) : bool
    {
        return $amount->greaterThan(self::zero());
    }

    /**
     * Returns true if amount value is >= 0.00, false otherwise.
     *
     * @param Money $amount
     * @return bool
     */
    public static function greaterThanOrEqualZero(Money $amount) : bool
    {
        return $amount->greaterThanOrEqual(self::zero());
    }

    /**
     * Returns true if amount value is < 0.00, false otherwise.
     *
     * @param Money $amount
     * @return bool
     */
    public static function lessThanZero(Money $amount) : bool
    {
        return $amount->lessThan(self::zero());
    }

    /**
     * Returns true if amount value is <= 0.00, false otherwise.
     *
     * @param Money $amount
     * @return bool
     */
    public static function lessThanOrEqualZero(Money $amount) : bool
    {
        return $amount->lessThanOrEqual(self::zero());
    }

    /**
     * Returns true if amount value is = 0.00, false otherwise.
     *
     * @param Money $amount
     * @return bool
     */
    public static function equalZero(Money $amount) : bool
    {
        return $amount->equals(self::zero());
    }

}
