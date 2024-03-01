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
namespace CakeDC\Money\View\Widget;

use Cake\View\Form\ContextInterface;
use Cake\View\StringTemplate;
use Cake\View\Widget\WidgetInterface;
use CakeDC\Money\Money;
use CakeDC\Money\Utility\MoneyUtil;

/**
 * Class MoneyWidget
 *
 * @package CakeDC\Money\View\Widget
 */
class MoneyWidget implements WidgetInterface
{
    /**
     * StringTemplate instance.
     *
     * @var \Cake\View\StringTemplate
     */
    protected StringTemplate $templates;

    /**
     * Constructor.
     *
     * @param \Cake\View\StringTemplate $templates Templates list.
     */
    public function __construct(StringTemplate $templates)
    {
        $this->templates = $templates;
    }

    /**
     * Converts the $data into one or many HTML elements.
     *
     * @param array $data The data to render.
     * @param \Cake\View\Form\ContextInterface $context The current form context.
     * @return string Generated HTML for the widget element.
     */
    public function render(array $data, ContextInterface $context): string
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

        return $this->templates->format('input', [
            'name' => $data['name'],
            'type' => 'number',
            'templateVars' => $data['templateVars'],
            'attrs' => $this->templates->formatAttributes(
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
    public function secureFields(array $data): array
    {
        return [$data['name']];
    }
}
