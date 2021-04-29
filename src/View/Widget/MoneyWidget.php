<?php

namespace CakeDC\Accounting\View\Widget;

use Cake\View\Form\ContextInterface;
use Cake\View\Widget\WidgetInterface;
use CakeDC\Accounting\Utility\MoneyUtil;
use Money\Money;

class MoneyWidget implements WidgetInterface
{
    /**
     * StringTemplate instance.
     *
     * @var \Cake\View\StringTemplate
     */
    protected $_templates;

    /**
     * Constructor.
     *
     * @param \Cake\View\StringTemplate $templates Templates list.
     */
    public function __construct($templates)
    {
        $this->_templates = $templates;
    }

    /**
     * Converts the $data into one or many HTML elements.
     *
     * @param array $data The data to render.
     * @param \Cake\View\Form\ContextInterface $context The current form context.
     * @return string Generated HTML for the widget element.
     */
    public function render(array $data, ContextInterface $context)
    {
        if ($data['val'] instanceof Money) {
            $data['value'] = MoneyUtil::float($data['val']);
        }

        if (!empty($data['max']) && $data['max'] instanceof Money) {
            $data['max'] = MoneyUtil::float($data['max']);
        }
        if (!empty($data['min']) && $data['min'] instanceof Money) {
            $data['min'] = MoneyUtil::float($data['min']);
        }
        $data['class'] = ($data['class'] ?? '') . ' form-control';
        $data['step'] = '.01';
        return $this->_templates->format('input', [
            'name' => $data['name'],
            'type' => 'number',
            'templateVars' => $data['templateVars'],
            'attrs' => $this->_templates->formatAttributes(
                $data,
                ['name', 'type']
            ),
        ]);
    }

    /**
     * Returns a list of fields that need to be secured for
     * this widget. Fields are in the form of Model[field][suffix]
     *
     * @param array $data The data to render.
     * @return array Array of fields to secure.
     */
    public function secureFields(array $data)
    {
        return [$data['name']];
    }
}