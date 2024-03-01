<?php
declare(strict_types=1);

namespace CakeDC\Money\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\StringTemplate;
use CakeDC\Money\Utility\MoneyUtil;
use CakeDC\Money\View\Widget\MoneyWidget;

/**
 * CakeDC\Money\View\Helper\MoneyHelper Test Case
 */
class MoneyWidgetTest extends TestCase
{
    /**
     * @var \Cake\View\StringTemplate
     */
    public $templates;

    /**
     * @var \Cake\View\Form\ContextInterface
     */
    public $context;

    /**
     * Test subject
     *
     * @var \CakeDC\Money\View\Helper\MoneyHelper
     */
    protected $MoneyHelper;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $templates = [
            'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
        ];
        $this->templates = new StringTemplate($templates);
        $this->context = $this->getMockBuilder('Cake\View\Form\ContextInterface')->getMock();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->templates);
        unset($this->context);
        parent::tearDown();
    }

    public function testInputMoneyWidget(): void
    {
        $money = new MoneyWidget($this->templates);
        $data = [
            'name' => 'amount',
            'val' => 10,
            'templateVars' => [],
        ];
        $this->assertTextContains('type="number"', $money->render($data, $this->context));

        $data = [
            'name' => 'amount',
            'val' => MoneyUtil::money(10),
            'templateVars' => [],
        ];
        $this->assertTextContains('type="number"', $money->render($data, $this->context));
    }

    public function testInputMoneyWidgetMaxMin(): void
    {
        $money = new MoneyWidget($this->templates);
        $data = [
            'name' => 'amount',
            'val' => 10,
            'max' => 15,
            'min' => 5,
            'templateVars' => [],
        ];

        $this->assertTextContains('max="15"', $money->render($data, $this->context));
        $this->assertTextContains('min="5"', $money->render($data, $this->context));

        $money = new MoneyWidget($this->templates);
        $data = [
            'name' => 'amount',
            'val' => MoneyUtil::money(10),
            'max' => MoneyUtil::money(15),
            'min' => MoneyUtil::money(5),
            'templateVars' => [],
        ];

        $this->assertTextContains('max="15"', $money->render($data, $this->context));
        $this->assertTextContains('min="5"', $money->render($data, $this->context));
    }

    public function testSecureFields(): void
    {
        $money = new MoneyWidget($this->templates);
        $data = [
            'name' => 'amount',
            'val' => 10,
            'max' => 15,
            'min' => 5,
            'templateVars' => [],
        ];

        $this->assertTrue(in_array('amount', $money->secureFields($data)));
    }
}
