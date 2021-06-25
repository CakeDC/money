<?php
declare(strict_types=1);

namespace CakeDC\Money\Test\TestCase\View\Helper;

use CakeDC\Money\View\Helper\MoneyHelper;
use Cake\TestSuite\TestCase;
use Cake\View\Helper\FormHelper;
use Cake\View\View;
use CakeDC\Money\Money;
use Money\Currency;
use Money\Money as MoneyMoney;

/**
 * CakeDC\Money\View\Helper\MoneyHelper Test Case
 */
class MoneyWidgetTest extends TestCase
{
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
        $view = new View();
        $this->FormHelper = new FormHelper($view);
        $this->MoneyHelper = new MoneyHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->MoneyHelper);
        parent::tearDown();
    }

    public function testInputMoneyWidget(): void
    {
        $this->assertTextContains('type="number"', $this->FormHelper->money('money'));
    }

}