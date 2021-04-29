<?php


namespace CakeDC\Money\View\Helper;


use Cake\View\Helper;
use CakeDC\Accounting\Utility\MoneyUtil;
use Money\Money;

/**
 * Class MoneyFormatterHelper
 * @package CakeDC\Money\View\Helper
 */
class MoneyFormatterHelper extends Helper
{

    /**
     * @param $value
     * @return string
     */
    public function currency($value)
    {
        $class = '';
        if ($value instanceof Money) {
            $value = MoneyUtil::float($value);
        }
        if ($value < 0) {
            $class = 'negative-balance';
        }
        return $this->Html->tag('span', parent::currency($value), ['class' => $class]);
    }
}
