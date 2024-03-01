<?php
declare(strict_types=1);

namespace CakeDC\Money\Test\TestCase\Utility;

use Cake\TestSuite\TestCase;
use CakeDC\Money\Database\Type\MoneyType;
use CakeDC\Money\Utility\MoneyUtil;
use PDO;

/**
 * CakeDC\Money\Database\Type\MoneyTypeTest Test Case
 */
class MoneyTypeTest extends TestCase
{
    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->moneyType = new MoneyType();
        $this->driver = $this->getMockBuilder('Cake\Database\Driver')->getMock();
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

    public function testToPhp()
    {
        $this->assertNull($this->moneyType->toPHP(null, $this->driver));
        $this->assertInstanceOf(\CakeDC\Money\Money::class, $this->moneyType->toPHP(100, $this->driver));
    }

    public function testMarshal()
    {
        $this->assertNull($this->moneyType->marshal(null));
        $this->assertInstanceOf(\CakeDC\Money\Money::class, $this->moneyType->marshal(100));
    }

    public function testToDatabase()
    {
        $this->assertNull($this->moneyType->toDatabase(null, $this->driver));
        $this->assertEquals('10000', $this->moneyType->toDatabase(MoneyUtil::money(100), $this->driver));
    }

    public function testToDatabaseInvalidArgument()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->moneyType->toDatabase(100, $this->driver);
    }

    public function testToStatement()
    {
        $this->assertEquals(PDO::PARAM_NULL, $this->moneyType->toStatement(null, $this->driver));
        $this->assertEquals(PDO::PARAM_INT, $this->moneyType->toStatement(100, $this->driver));
    }
}
