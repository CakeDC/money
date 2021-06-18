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
namespace CakeDC\Money\Database\Type;

use Cake\Core\Configure;

use Cake\Database\DriverInterface;
use Cake\Database\Type\BaseType;
use Cake\Database\TypeInterface;
use Cake\Error\Debugger;
use CakeDC\Money\Utility\MoneyUtil;
use CakeDC\Money\Money;
use http\Exception\RuntimeException;
use Money\Money as MoneyPHP;
use PDO;

/**
 * Class MoneyType
 *
 * @package CakeDC\Money\Database\Type
 */
class MoneyType extends BaseType implements TypeInterface
{

    /**
     * Casts given value from a database type to a PHP equivalent.
     *
     * @param mixed $value Value to be converted to PHP equivalent
     * @param \Cake\Database\DriverInterface $driver Object from which database preferences and configuration will be extracted
     * @return ?Money Given value casted from a database to a PHP equivalent.
     */
    public function toPHP($value, DriverInterface $driver) : ?Money
    {
        if ($value === null) {
            return null;
        }

        $currency = Configure::read('Money.currency', 'USD');

        return Money::$currency($value == '' ? '0' : $value);
    }

    /**
     * Marshals flat data into PHP objects.
     *
     * Most useful for converting request data into PHP objects,
     * that make sense for the rest of the ORM/Database layers.
     *
     * @param mixed $value The value to convert.
     * @return ?Money Converted value.
     */
    public function marshal($value) : ?Money
    {
        if ($value === null) {
            return null;
        }
        $currency = Configure::read('Money.currency', 'USD');

        return MoneyUtil::money($value);
    }

    /**
     * Casts given value from a PHP type to one acceptable by a database.
     *
     * @param ?Money $value Value to be converted to a database equivalent.
     * @param \Cake\Database\DriverInterface $driver Object from which database preferences and configuration will be extracted.
     * @return ?string Given PHP type casted to one acceptable by a database.
     */
    public function toDatabase($value, DriverInterface $driver) : ?string
    {

        if ($value === null) {
            return null;
        }
        if (!($value instanceof Money)) {
            throw new \InvalidArgumentException(__('Value must be instance of Money'));
        }

        return $value->getAmount();
    }

    /**
     * Casts given value to its Statement equivalent.
     *
     * @param mixed $value Value to be converted to PDO statement.
     * @param \Cake\Database\DriverInterface $driver Object from which database preferences and configuration will be extracted.
     * @return int Given value casted to its Statement equivalent.
     */
    public function toStatement($value, DriverInterface $driver) : int
    {
        if ($value === null) {
            return PDO::PARAM_NULL;
        }

        return PDO::PARAM_INT;
    }

}
