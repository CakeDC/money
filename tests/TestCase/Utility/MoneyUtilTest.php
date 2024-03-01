<?php
declare(strict_types=1);

namespace CakeDC\Money\Test\TestCase\Utility;

use Cake\Core\Configure;
use Cake\TestSuite\TestCase;
use CakeDC\Money\Money;
use CakeDC\Money\Utility\MoneyUtil;
use Exception;
use RuntimeException;

/**
 * CakeDC\Money\View\Helper\MoneyHelper Test Case
 */
class MoneyUtilTest extends TestCase
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
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testMoneyNumericValue(): void
    {
        $this->assertInstanceOf(
            Money::class,
            MoneyUtil::money(100)
        );

        $this->assertInstanceOf(
            Money::class,
            MoneyUtil::money(100, true)
        );

        $this->assertInstanceOf(
            Money::class,
            MoneyUtil::money(-100)
        );

        $this->assertInstanceOf(
            Money::class,
            MoneyUtil::money(100.15)
        );

        $this->assertInstanceOf(
            Money::class,
            MoneyUtil::money(100.1)
        );
    }

    public function testMoneyStringValue(): void
    {
        $this->assertInstanceOf(
            Money::class,
            MoneyUtil::money('100')
        );

        $this->assertInstanceOf(
            Money::class,
            MoneyUtil::money('100', true)
        );

        $this->assertInstanceOf(
            Money::class,
            MoneyUtil::money('-100')
        );

        $this->assertInstanceOf(
            Money::class,
            MoneyUtil::money('100.15')
        );
    }

    public function testMoneyNullValue(): void
    {
        $this->assertNull(
            MoneyUtil::money('')
        );

        $this->assertInstanceOf(
            Money::class,
            MoneyUtil::money(0)
        );
    }

    public function testMoneyClassValue(): void
    {
        $money = MoneyUtil::money(10);

        $this->assertInstanceOf(
            Money::class,
            MoneyUtil::money($money)
        );

        $this->assertEquals(
            $money,
            MoneyUtil::money($money)
        );
    }

    public function testFloat(): void
    {
        $money = MoneyUtil::money(100.15);
        $this->assertEquals(100.15, MoneyUtil::float($money));

        $money = MoneyUtil::money(200);
        $this->assertEquals(200.00, MoneyUtil::float($money));
    }

    public function testFormat()
    {
        $money = MoneyUtil::money(100.15);
        $this->assertEquals('$100.15', MoneyUtil::format($money));

        $money = MoneyUtil::money(200);
        $this->assertEquals('$200.00', MoneyUtil::format($money));
    }

    public function testFormatCurrencies()
    {
        Configure::write('Money.currency', 'EUR');

        $money = MoneyUtil::money(100.15);
        $this->assertEquals('€100.15', MoneyUtil::format($money));

        $money = MoneyUtil::money('200');
        $this->assertEquals('€200.00', MoneyUtil::format($money));
    }

    public function testFormatBitcoin()
    {
        Configure::write('Money.currency', 'XBT');
        $money = MoneyUtil::money(1);

        $this->assertInstanceOf(Money::class, $money);
        $this->assertEquals('Ƀ0.0000010', MoneyUtil::format($money));
    }

    public function testFormatOther()
    {
        try {
            Configure::write('Money.currency', 'NotCurrency');
            $money = MoneyUtil::money(100.15);
            MoneyUtil::format($money);
        } catch (Exception $e) {
            $this->assertInstanceOf(RuntimeException::class, $e);
        }
    }

    public function testZero()
    {
        $money = MoneyUtil::zero();

        $this->assertInstanceOf(
            Money::class,
            $money
        );

        $this->assertEquals('$0.00', $money->__toString());
    }

    public function testGreaterThanZero()
    {
        $money = MoneyUtil::money(100);
        $this->assertTrue(MoneyUtil::greaterThanZero($money));

        $money = MoneyUtil::money(-100);
        $this->assertFalse(MoneyUtil::greaterThanZero($money));
    }

    public function testGreaterThanOrEqualZero()
    {
        $money = MoneyUtil::money(100);
        $this->assertTrue(MoneyUtil::greaterThanOrEqualZero($money));

        $money = MoneyUtil::money(-100);
        $this->assertFalse(MoneyUtil::greaterThanOrEqualZero($money));

        $this->assertTrue(MoneyUtil::greaterThanOrEqualZero(MoneyUtil::zero()));
    }

    public function testLessThanZero()
    {
        $money = MoneyUtil::money(100);
        $this->assertFalse(MoneyUtil::lessThanZero($money));

        $money = MoneyUtil::money(-100);
        $this->assertTrue(MoneyUtil::lessThanZero($money));
    }

    public function testLessThanOrEqualZero()
    {
        $money = MoneyUtil::money(100);
        $this->assertFalse(MoneyUtil::lessThanOrEqualZero($money));

        $money = MoneyUtil::money(-100);
        $this->assertTrue(MoneyUtil::lessThanOrEqualZero($money));

        $this->assertTrue(MoneyUtil::lessThanOrEqualZero(MoneyUtil::zero()));
    }

    public function testEqualZero()
    {
        $money = MoneyUtil::money(100);
        $this->assertFalse(MoneyUtil::equalZero($money));

        $this->assertTrue(MoneyUtil::equalZero(MoneyUtil::zero()));
    }
}
