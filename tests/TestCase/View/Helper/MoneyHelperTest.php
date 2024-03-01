<?php
declare(strict_types=1);

namespace CakeDC\Money\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use CakeDC\Money\Utility\MoneyUtil;
use CakeDC\Money\View\Helper\MoneyHelper;

/**
 * CakeDC\Money\View\Helper\MoneyHelper Test Case
 */
class MoneyHelperTest extends TestCase
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

    /**
     * Test currency method
     *
     * @return void
     */
    public function testCurrency(): void
    {
        $this->assertEquals(
            '<span class="">$100.00</span>',
            $this->MoneyHelper->currency(100)
        );

        $this->assertEquals(
            '<span class="">$100.00</span>',
            $this->MoneyHelper->currency('100')
        );

        $this->assertEquals(
            '<span class="negative-balance">-$100.00</span>',
            $this->MoneyHelper->currency(-100)
        );

        $this->assertEquals(
            '<span class="negative-balance">-$100.00</span>',
            $this->MoneyHelper->currency('-100')
        );

        $this->assertEquals(
            '<span class="">$100.00</span>',
            $this->MoneyHelper->currency(MoneyUtil::money(100))
        );

        $this->assertEquals(
            '<span class="">$100.00</span>',
            $this->MoneyHelper->currency(MoneyUtil::money('100'))
        );
    }
}
