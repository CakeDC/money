<?php
declare(strict_types=1);

namespace CakeDC\Money\Test\TestCase\Utility;

//use CakeDC\Money\View\Helper\MoneyHelper;
use Cake\TestSuite\TestCase;
use CakeDC\Money\Utility\MoneyUtil;

//use Cake\View\View;
//use CakeDC\Money\Money;
//use Money\Currency;
//use Money\Money as MoneyMoney;

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

        //$view = new View();
        //$this->MoneyHelper = new MoneyHelper($view);
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


    public function testMoney(): void
    {
        $this->assertInstanceOf(
            \CakeDC\Money\Money::class,
            MoneyUtil::money(100)
        );

        $this->assertInstanceOf(
            \CakeDC\Money\Money::class,
            MoneyUtil::money(100, true)
        );

        $this->assertInstanceOf(
            \CakeDC\Money\Money::class,
            MoneyUtil::money('100')
        );

        $this->assertInstanceOf(
            \CakeDC\Money\Money::class,
            MoneyUtil::money(-100)
        );

        $this->assertInstanceOf(
            \CakeDC\Money\Money::class,
            MoneyUtil::money(100.15)
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

    public function testZero()
    {
        $money = MoneyUtil::zero();

        $this->assertInstanceOf(
            \CakeDC\Money\Money::class,
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