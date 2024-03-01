<?php
declare(strict_types=1);

/**
 * Copyright 2021, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2021, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

namespace CakeDC\Money;

use CakeDC\Money\Utility\MoneyUtil;
use Money\Money as MoneyPHP;

/**
 * Class Money
 *
 * This class encapsulates MoneyPHP\Money and extends features
 *
 * @method bool isSameCurrency(\CakeDC\Money\Money $other) See \Money\Money::isSameCurrency()
 * @method bool equals(\CakeDC\Money\Money $other) See \Money\Money::equals()
 * @method int compare(\CakeDC\Money\Money $other) See \Money\Money::compare()
 * @method bool greaterThan(\CakeDC\Money\Money $other) See \Money\Money::greaterThan()
 * @method bool greaterThanOrEqual(\CakeDC\Money\Money $other) See \Money\Money::greaterThanOrEqual()
 * @method bool lessThan(\CakeDC\Money\Money $other) See \Money\Money::lessThan()
 * @method bool lessThanOrEqual(\CakeDC\Money\Money $other) See \Money\Money::lessThanOrEqual()
 * @method string getAmount() See \Money\Money::getAmount()
 * @method \Money\Currency getCurrency() See \Money\Money::getCurrency()
 * @method \CakeDC\Money\Money add(\CakeDC\Money\Money ...$addends) See \Money\Money::add()
 * @method \CakeDC\Money\Money subtract(\CakeDC\Money\Money ...$subtrahends) See \Money\Money::subtract()
 * @method \CakeDC\Money\Money multiply($multiplier, $roundingMode = \CakeDC\Money\Money::ROUND_HALF_UP) See \Money\Money::multiply()
 * @method \CakeDC\Money\Money divide($divisor, $roundingMode = \CakeDC\Money\Money::ROUND_HALF_UP) See \Money\Money::divide()
 * @method \CakeDC\Money\Money mod(\CakeDC\Money\Money $divisor) See \Money\Money::mod()
 * @method \CakeDC\Money\Money[] allocate(array $ratios) See \Money\Money::allocate()
 * @method \CakeDC\Money\Money[] allocateTo($n) See \Money\Money::allocateTo()
 * @method string ratioOf(\CakeDC\Money\Money $money) See \Money\Money::ratioOf()
 * @method \CakeDC\Money\Money absolute() See \Money\Money::absolute()
 * @method \CakeDC\Money\Money negative() See \Money\Money::negative()
 * @method bool isZero() See \Money\Money::isZero()
 * @method bool isPositive() See \Money\Money::isPositive()
 * @method bool isNegative() See \Money\Money::isNegative()
 * @method bool jsonSerialize() See \Money\Money::jsonSerialize()
 * @method static \CakeDC\Money\Money min(\CakeDC\Money\Money $first, \CakeDC\Money\Money ...$collection) See \Money\Money::min()
 * @method static \CakeDC\Money\Money max(\CakeDC\Money\Money $first, \CakeDC\Money\Money ...$collection) See \Money\Money::max()
 * @method static \CakeDC\Money\Money sum(\CakeDC\Money\Money $first, \CakeDC\Money\Money ...$collection) See \Money\Money::sum()
 * @method static \CakeDC\Money\Money avg(\CakeDC\Money\Money $first, \CakeDC\Money\Money ...$collection) See \Money\Money::avg()
 * @method static void registerCalculator(string $calculator) See \Money\Money::registerCalculator()
 * @see \Money\Money
 * @package CakeDC\Money
 */
class Money
{
    public const ROUND_HALF_UP = PHP_ROUND_HALF_UP;

    public const ROUND_HALF_DOWN = PHP_ROUND_HALF_DOWN;

    public const ROUND_HALF_EVEN = PHP_ROUND_HALF_EVEN;

    public const ROUND_HALF_ODD = PHP_ROUND_HALF_ODD;

    public const ROUND_UP = 5;

    public const ROUND_DOWN = 6;

    public const ROUND_HALF_POSITIVE_INFINITY = 7;

    public const ROUND_HALF_NEGATIVE_INFINITY = 8;

    /**
     * @var \Money\Money
     */
    protected $_money;

    /**
     * @return \Money\Money
     */
    public function getMoney(): MoneyPHP
    {
        return $this->_money;
    }

    public function __construct(MoneyPHP $money)
    {
        $this->_money = $money;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return false|mixed
     */
    public function __call(string $name, array $arguments)
    {
        $arguments = self::processArguments($arguments);
        // @phpstan-ignore-next-line
        $result = call_user_func_array([$this->_money, $name], $arguments);
        if ($result instanceof MoneyPHP) {
            return new self($result);
        }

        return $result;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return false|mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $arguments = self::processArguments($arguments);

        // @phpstan-ignore-next-line
        return new self(forward_static_call_array([MoneyPHP::class, $name], $arguments));
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return MoneyUtil::format($this);
    }

    /**
     * @param array $arguments
     * @return array
     */
    protected static function processArguments($arguments = [])
    {
        for ($i = 0; $i < count($arguments); $i++) {
            if ($arguments[$i] instanceof Money) {
                $arguments[$i] = $arguments[$i]->getMoney();
            }
        }

        return $arguments;
    }
}
