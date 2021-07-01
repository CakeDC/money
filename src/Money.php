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

namespace CakeDC\Money;

use CakeDC\Money\Utility\MoneyUtil;
use Money\Money as MoneyPHP;

/**
 * Class Money
 *
 * This class encapsulates MoneyPHP\Money and extends features
 *
 * @package CakeDC\Money
 */
class Money
{

    /**
     * @var MoneyPHP
     */
    protected $_money;

    /**
     * @return MoneyPHP
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
     * @param $name
     * @param $arguments
     * @return false|mixed
     */
    public function __call($name, $arguments)
    {
        $arguments = self::processArguments($arguments);

        return call_user_func_array([$this->_money, $name], $arguments);
    }

    /**
     * @param $name
     * @param $arguments
     * @return false|mixed
     */
    public static function __callStatic($name, $arguments)
    {
        $arguments = self::processArguments($arguments);

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
        for ($i=0; $i < count($arguments); $i++) { 
            if ($arguments[$i] instanceof Money) {
                $arguments[$i] = $arguments[$i]->getMoney();
            }
        }

        return $arguments;
    }
}
