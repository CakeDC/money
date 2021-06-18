<?php
declare(strict_types=1);

namespace CakeDC\Money\Test\TestCase\View\Helper;

use CakeDC\Money\View\Helper\MoneyHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

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
        $this->markTestIncomplete('Not implemented yet.');
    }
}
