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
namespace CakeDC\Money\View\Helper;

use Cake\View\Helper;
use CakeDC\Money\Money;
use CakeDC\Money\Utility\MoneyUtil;

/**
 * Class MoneyHelper
 *
 * @package CakeDC\Money\View\Helper
 * @property \Cake\View\Helper\HtmlHelper $Html
 * @property \Cake\View\Helper\NumberHelper $Number
 */
class MoneyHelper extends Helper
{
    /**
     * @inheritDoc
     */
    protected array $helpers = ['Html', 'Number'];

    /**
     * @param array $config
     */
    public function initialize(array $config): void
    {
        if ($this->getView()->helpers()->has('Form')) {
            $this->getView()->helpers()->get('Form')->setConfig('typeMap', ['money' => 'money']);
        } else {
            $this->getView()->loadHelper('Form', ['typeMap' => ['money' => 'money']]);
        }

        $this->getView()->Form->addWidget('money', ['CakeDC/Money.Money']);

        parent::initialize($config);
    }

    /**
     * Format number or money as currency.
     *
     * @param \CakeDC\Money\Money|string|float $value
     * @return string
     */
    public function currency(Money|float|string $value): string
    {
        $class = '';
        if ($value instanceof Money) {
            $output = MoneyUtil::format($value);
        } else {
            $output = $this->Number->currency($value);
        }
        if (
            (is_numeric($value) && $value < 0) ||
            ($value instanceof Money && MoneyUtil::lessThanZero($value))
        ) {
            $class = 'negative-balance';
        }

        return $this->Html->tag('span', $output, ['class' => $class]);
    }
}
