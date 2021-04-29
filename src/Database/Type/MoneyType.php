<?php


namespace CakeDC\Accounting\Database\Type;
use Cake\Database\Driver;
use Cake\Database\Type;
use Cake\Database\TypeInterface;
use Cake\Error\Debugger;
use Money\Money;
use PDO;

class MoneyType extends \Cake\Database\Type implements TypeInterface
{

    public function toPHP($value, Driver $driver)
    {
        if ($value === null) {
            return null;
        }

        return Money::USD($value == '' ? '0' : $value);
    }

    public function marshal($value)
    {
        if ($value === null) {
            return null;
        }

        return $value;
    }

    public function toDatabase($value, Driver $driver)
    {
        if ($value === null) {
            return null;
        }
        if (!($value instanceof Money)) {
            throw new \InvalidArgumentException(__('Value must be instance of Money'));
        }

        return $value->getAmount();
    }

    public function toStatement($value, Driver $driver)
    {
        if ($value === null) {
            return PDO::PARAM_NULL;
        }
        return PDO::PARAM_INT;
    }

}
