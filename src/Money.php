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

namespace CakeDC\Money;

use CakeDC\Money\Utility\MoneyUtil;
use Money\Money as MoneyPHP;

/**
 * Class Money
 *
 * This class encapsulates MoneyPHP\Money and extends features
 *
 * @method bool isSameCurrency(\CakeDC\Money\Money $other) See \Money\Money::isSameCurrency()
 * @method bool equals(\CakeDC\Money\Money $other) See \Money\Money::equals()
 * @method int compare(\CakeDC\Money\Money $other) See \Money\Money::compare()
 * @method bool greaterThan(\CakeDC\Money\Money $other) See \Money\Money::greaterThan()
 * @method bool greaterThanOrEqual(\CakeDC\Money\Money $other) See \Money\Money::greaterThanOrEqual()
 * @method bool lessThan(\CakeDC\Money\Money $other) See \Money\Money::lessThan()
 * @method bool lessThanOrEqual(\CakeDC\Money\Money $other) See \Money\Money::lessThanOrEqual()
 * @method string getAmount() See \Money\Money::getAmount()
 * @method \Money\Currency getCurrency() See \Money\Money::getCurrency()
 * @method \CakeDC\Money\Money add(\CakeDC\Money\Money ...$addends) See \Money\Money::add()
 * @method \CakeDC\Money\Money subtract(\CakeDC\Money\Money ...$subtrahends) See \Money\Money::subtract()
 * @method \CakeDC\Money\Money multiply($multiplier, $roundingMode = \CakeDC\Money\Money::ROUND_HALF_UP) See \Money\Money::multiply()
 * @method \CakeDC\Money\Money divide($divisor, $roundingMode = \CakeDC\Money\Money::ROUND_HALF_UP) See \Money\Money::divide()
 * @method \CakeDC\Money\Money mod(\CakeDC\Money\Money $divisor) See \Money\Money::mod()
 * @method \CakeDC\Money\Money[] allocate(array $ratios) See \Money\Money::allocate()
 * @method \CakeDC\Money\Money[] allocateTo($n) See \Money\Money::allocateTo()
 * @method string ratioOf(\CakeDC\Money\Money $money) See \Money\Money::ratioOf()
 * @method \CakeDC\Money\Money absolute() See \Money\Money::absolute()
 * @method \CakeDC\Money\Money negative() See \Money\Money::negative()
 * @method bool isZero() See \Money\Money::isZero()
 * @method bool isPositive() See \Money\Money::isPositive()
 * @method bool isNegative() See \Money\Money::isNegative()
 * @method bool jsonSerialize() See \Money\Money::jsonSerialize()
 * @method static \CakeDC\Money\Money min(\CakeDC\Money\Money $first, \CakeDC\Money\Money ...$collection) See \Money\Money::min()
 * @method static \CakeDC\Money\Money max(\CakeDC\Money\Money $first, \CakeDC\Money\Money ...$collection) See \Money\Money::max()
 * @method static \CakeDC\Money\Money sum(\CakeDC\Money\Money $first, \CakeDC\Money\Money ...$collection) See \Money\Money::sum()
 * @method static \CakeDC\Money\Money avg(\CakeDC\Money\Money $first, \CakeDC\Money\Money ...$collection) See \Money\Money::avg()
 * @method static void registerCalculator(string $calculator) See \Money\Money::registerCalculator()
 * @method static \CakeDC\Money\Money AED(string|int $amount) See \Money\MoneyFactory::AED()
 * @method static \CakeDC\Money\Money ALL(string|int $amount) See \Money\MoneyFactory::ALL()
 * @method static \CakeDC\Money\Money AMD(string|int $amount) See \Money\MoneyFactory::AMD()
 * @method static \CakeDC\Money\Money ANG(string|int $amount) See \Money\MoneyFactory::ANG()
 * @method static \CakeDC\Money\Money AOA(string|int $amount) See \Money\MoneyFactory::AOA()
 * @method static \CakeDC\Money\Money ARS(string|int $amount) See \Money\MoneyFactory::ARS()
 * @method static \CakeDC\Money\Money AUD(string|int $amount) See \Money\MoneyFactory::AUD()
 * @method static \CakeDC\Money\Money AWG(string|int $amount) See \Money\MoneyFactory::AWG()
 * @method static \CakeDC\Money\Money AZN(string|int $amount) See \Money\MoneyFactory::AZN()
 * @method static \CakeDC\Money\Money BAM(string|int $amount) See \Money\MoneyFactory::BAM()
 * @method static \CakeDC\Money\Money BBD(string|int $amount) See \Money\MoneyFactory::BBD()
 * @method static \CakeDC\Money\Money BDT(string|int $amount) See \Money\MoneyFactory::BDT()
 * @method static \CakeDC\Money\Money BGN(string|int $amount) See \Money\MoneyFactory::BGN()
 * @method static \CakeDC\Money\Money BHD(string|int $amount) See \Money\MoneyFactory::BHD()
 * @method static \CakeDC\Money\Money BIF(string|int $amount) See \Money\MoneyFactory::BIF()
 * @method static \CakeDC\Money\Money BMD(string|int $amount) See \Money\MoneyFactory::BMD()
 * @method static \CakeDC\Money\Money BND(string|int $amount) See \Money\MoneyFactory::BND()
 * @method static \CakeDC\Money\Money BOB(string|int $amount) See \Money\MoneyFactory::BOB()
 * @method static \CakeDC\Money\Money BOV(string|int $amount) See \Money\MoneyFactory::BOV()
 * @method static \CakeDC\Money\Money BRL(string|int $amount) See \Money\MoneyFactory::BRL()
 * @method static \CakeDC\Money\Money BSD(string|int $amount) See \Money\MoneyFactory::BSD()
 * @method static \CakeDC\Money\Money BTN(string|int $amount) See \Money\MoneyFactory::BTN()
 * @method static \CakeDC\Money\Money BWP(string|int $amount) See \Money\MoneyFactory::BWP()
 * @method static \CakeDC\Money\Money BYN(string|int $amount) See \Money\MoneyFactory::BYN()
 * @method static \CakeDC\Money\Money BZD(string|int $amount) See \Money\MoneyFactory::BZD()
 * @method static \CakeDC\Money\Money CAD(string|int $amount) See \Money\MoneyFactory::CAD()
 * @method static \CakeDC\Money\Money CDF(string|int $amount) See \Money\MoneyFactory::CDF()
 * @method static \CakeDC\Money\Money CHE(string|int $amount) See \Money\MoneyFactory::CHE()
 * @method static \CakeDC\Money\Money CHF(string|int $amount) See \Money\MoneyFactory::CHF()
 * @method static \CakeDC\Money\Money CHW(string|int $amount) See \Money\MoneyFactory::CHW()
 * @method static \CakeDC\Money\Money CLF(string|int $amount) See \Money\MoneyFactory::CLF()
 * @method static \CakeDC\Money\Money CLP(string|int $amount) See \Money\MoneyFactory::CLP()
 * @method static \CakeDC\Money\Money CNY(string|int $amount) See \Money\MoneyFactory::CNY()
 * @method static \CakeDC\Money\Money COP(string|int $amount) See \Money\MoneyFactory::COP()
 * @method static \CakeDC\Money\Money COU(string|int $amount) See \Money\MoneyFactory::COU()
 * @method static \CakeDC\Money\Money CRC(string|int $amount) See \Money\MoneyFactory::CRC()
 * @method static \CakeDC\Money\Money CUC(string|int $amount) See \Money\MoneyFactory::CUC()
 * @method static \CakeDC\Money\Money CUP(string|int $amount) See \Money\MoneyFactory::CUP()
 * @method static \CakeDC\Money\Money CVE(string|int $amount) See \Money\MoneyFactory::CVE()
 * @method static \CakeDC\Money\Money CZK(string|int $amount) See \Money\MoneyFactory::CZK()
 * @method static \CakeDC\Money\Money DJF(string|int $amount) See \Money\MoneyFactory::DJF()
 * @method static \CakeDC\Money\Money DKK(string|int $amount) See \Money\MoneyFactory::DKK()
 * @method static \CakeDC\Money\Money DOP(string|int $amount) See \Money\MoneyFactory::DOP()
 * @method static \CakeDC\Money\Money DZD(string|int $amount) See \Money\MoneyFactory::DZD()
 * @method static \CakeDC\Money\Money EGP(string|int $amount) See \Money\MoneyFactory::EGP()
 * @method static \CakeDC\Money\Money ERN(string|int $amount) See \Money\MoneyFactory::ERN()
 * @method static \CakeDC\Money\Money ETB(string|int $amount) See \Money\MoneyFactory::ETB()
 * @method static \CakeDC\Money\Money EUR(string|int $amount) See \Money\MoneyFactory::EUR()
 * @method static \CakeDC\Money\Money FJD(string|int $amount) See \Money\MoneyFactory::FJD()
 * @method static \CakeDC\Money\Money FKP(string|int $amount) See \Money\MoneyFactory::FKP()
 * @method static \CakeDC\Money\Money GBP(string|int $amount) See \Money\MoneyFactory::GBP()
 * @method static \CakeDC\Money\Money GEL(string|int $amount) See \Money\MoneyFactory::GEL()
 * @method static \CakeDC\Money\Money GHS(string|int $amount) See \Money\MoneyFactory::GHS()
 * @method static \CakeDC\Money\Money GIP(string|int $amount) See \Money\MoneyFactory::GIP()
 * @method static \CakeDC\Money\Money GMD(string|int $amount) See \Money\MoneyFactory::GMD()
 * @method static \CakeDC\Money\Money GNF(string|int $amount) See \Money\MoneyFactory::GNF()
 * @method static \CakeDC\Money\Money GTQ(string|int $amount) See \Money\MoneyFactory::GTQ()
 * @method static \CakeDC\Money\Money GYD(string|int $amount) See \Money\MoneyFactory::GYD()
 * @method static \CakeDC\Money\Money HKD(string|int $amount) See \Money\MoneyFactory::HKD()
 * @method static \CakeDC\Money\Money HNL(string|int $amount) See \Money\MoneyFactory::HNL()
 * @method static \CakeDC\Money\Money HRK(string|int $amount) See \Money\MoneyFactory::HRK()
 * @method static \CakeDC\Money\Money HTG(string|int $amount) See \Money\MoneyFactory::HTG()
 * @method static \CakeDC\Money\Money HUF(string|int $amount) See \Money\MoneyFactory::HUF()
 * @method static \CakeDC\Money\Money IDR(string|int $amount) See \Money\MoneyFactory::IDR()
 * @method static \CakeDC\Money\Money ILS(string|int $amount) See \Money\MoneyFactory::ILS()
 * @method static \CakeDC\Money\Money INR(string|int $amount) See \Money\MoneyFactory::INR()
 * @method static \CakeDC\Money\Money IQD(string|int $amount) See \Money\MoneyFactory::IQD()
 * @method static \CakeDC\Money\Money IRR(string|int $amount) See \Money\MoneyFactory::IRR()
 * @method static \CakeDC\Money\Money ISK(string|int $amount) See \Money\MoneyFactory::ISK()
 * @method static \CakeDC\Money\Money JMD(string|int $amount) See \Money\MoneyFactory::JMD()
 * @method static \CakeDC\Money\Money JOD(string|int $amount) See \Money\MoneyFactory::JOD()
 * @method static \CakeDC\Money\Money JPY(string|int $amount) See \Money\MoneyFactory::JPY()
 * @method static \CakeDC\Money\Money KES(string|int $amount) See \Money\MoneyFactory::KES()
 * @method static \CakeDC\Money\Money KGS(string|int $amount) See \Money\MoneyFactory::KGS()
 * @method static \CakeDC\Money\Money KHR(string|int $amount) See \Money\MoneyFactory::KHR()
 * @method static \CakeDC\Money\Money KMF(string|int $amount) See \Money\MoneyFactory::KMF()
 * @method static \CakeDC\Money\Money KPW(string|int $amount) See \Money\MoneyFactory::KPW()
 * @method static \CakeDC\Money\Money KRW(string|int $amount) See \Money\MoneyFactory::KRW()
 * @method static \CakeDC\Money\Money KWD(string|int $amount) See \Money\MoneyFactory::KWD()
 * @method static \CakeDC\Money\Money KYD(string|int $amount) See \Money\MoneyFactory::KYD()
 * @method static \CakeDC\Money\Money KZT(string|int $amount) See \Money\MoneyFactory::KZT()
 * @method static \CakeDC\Money\Money LAK(string|int $amount) See \Money\MoneyFactory::LAK()
 * @method static \CakeDC\Money\Money LBP(string|int $amount) See \Money\MoneyFactory::LBP()
 * @method static \CakeDC\Money\Money LKR(string|int $amount) See \Money\MoneyFactory::LKR()
 * @method static \CakeDC\Money\Money LRD(string|int $amount) See \Money\MoneyFactory::LRD()
 * @method static \CakeDC\Money\Money LSL(string|int $amount) See \Money\MoneyFactory::LSL()
 * @method static \CakeDC\Money\Money LYD(string|int $amount) See \Money\MoneyFactory::LYD()
 * @method static \CakeDC\Money\Money MAD(string|int $amount) See \Money\MoneyFactory::MAD()
 * @method static \CakeDC\Money\Money MDL(string|int $amount) See \Money\MoneyFactory::MDL()
 * @method static \CakeDC\Money\Money MGA(string|int $amount) See \Money\MoneyFactory::MGA()
 * @method static \CakeDC\Money\Money MKD(string|int $amount) See \Money\MoneyFactory::MKD()
 * @method static \CakeDC\Money\Money MMK(string|int $amount) See \Money\MoneyFactory::MMK()
 * @method static \CakeDC\Money\Money MNT(string|int $amount) See \Money\MoneyFactory::MNT()
 * @method static \CakeDC\Money\Money MOP(string|int $amount) See \Money\MoneyFactory::MOP()
 * @method static \CakeDC\Money\Money MRU(string|int $amount) See \Money\MoneyFactory::MRU()
 * @method static \CakeDC\Money\Money MUR(string|int $amount) See \Money\MoneyFactory::MUR()
 * @method static \CakeDC\Money\Money MVR(string|int $amount) See \Money\MoneyFactory::MVR()
 * @method static \CakeDC\Money\Money MWK(string|int $amount) See \Money\MoneyFactory::MWK()
 * @method static \CakeDC\Money\Money MXN(string|int $amount) See \Money\MoneyFactory::MXN()
 * @method static \CakeDC\Money\Money MXV(string|int $amount) See \Money\MoneyFactory::MXV()
 * @method static \CakeDC\Money\Money MYR(string|int $amount) See \Money\MoneyFactory::MYR()
 * @method static \CakeDC\Money\Money MZN(string|int $amount) See \Money\MoneyFactory::MZN()
 * @method static \CakeDC\Money\Money NAD(string|int $amount) See \Money\MoneyFactory::NAD()
 * @method static \CakeDC\Money\Money NGN(string|int $amount) See \Money\MoneyFactory::NGN()
 * @method static \CakeDC\Money\Money NIO(string|int $amount) See \Money\MoneyFactory::NIO()
 * @method static \CakeDC\Money\Money NOK(string|int $amount) See \Money\MoneyFactory::NOK()
 * @method static \CakeDC\Money\Money NPR(string|int $amount) See \Money\MoneyFactory::NPR()
 * @method static \CakeDC\Money\Money NZD(string|int $amount) See \Money\MoneyFactory::NZD()
 * @method static \CakeDC\Money\Money OMR(string|int $amount) See \Money\MoneyFactory::OMR()
 * @method static \CakeDC\Money\Money PAB(string|int $amount) See \Money\MoneyFactory::PAB()
 * @method static \CakeDC\Money\Money PEN(string|int $amount) See \Money\MoneyFactory::PEN()
 * @method static \CakeDC\Money\Money PGK(string|int $amount) See \Money\MoneyFactory::PGK()
 * @method static \CakeDC\Money\Money PHP(string|int $amount) See \Money\MoneyFactory::PHP()
 * @method static \CakeDC\Money\Money PKR(string|int $amount) See \Money\MoneyFactory::PKR()
 * @method static \CakeDC\Money\Money PLN(string|int $amount) See \Money\MoneyFactory::PLN()
 * @method static \CakeDC\Money\Money PYG(string|int $amount) See \Money\MoneyFactory::PYG()
 * @method static \CakeDC\Money\Money QAR(string|int $amount) See \Money\MoneyFactory::QAR()
 * @method static \CakeDC\Money\Money RON(string|int $amount) See \Money\MoneyFactory::RON()
 * @method static \CakeDC\Money\Money RSD(string|int $amount) See \Money\MoneyFactory::RSD()
 * @method static \CakeDC\Money\Money RUB(string|int $amount) See \Money\MoneyFactory::RUB()
 * @method static \CakeDC\Money\Money RWF(string|int $amount) See \Money\MoneyFactory::RWF()
 * @method static \CakeDC\Money\Money SAR(string|int $amount) See \Money\MoneyFactory::SAR()
 * @method static \CakeDC\Money\Money SBD(string|int $amount) See \Money\MoneyFactory::SBD()
 * @method static \CakeDC\Money\Money SCR(string|int $amount) See \Money\MoneyFactory::SCR()
 * @method static \CakeDC\Money\Money SDG(string|int $amount) See \Money\MoneyFactory::SDG()
 * @method static \CakeDC\Money\Money SEK(string|int $amount) See \Money\MoneyFactory::SEK()
 * @method static \CakeDC\Money\Money SGD(string|int $amount) See \Money\MoneyFactory::SGD()
 * @method static \CakeDC\Money\Money SHP(string|int $amount) See \Money\MoneyFactory::SHP()
 * @method static \CakeDC\Money\Money SLL(string|int $amount) See \Money\MoneyFactory::SLL()
 * @method static \CakeDC\Money\Money SOS(string|int $amount) See \Money\MoneyFactory::SOS()
 * @method static \CakeDC\Money\Money SRD(string|int $amount) See \Money\MoneyFactory::SRD()
 * @method static \CakeDC\Money\Money SSP(string|int $amount) See \Money\MoneyFactory::SSP()
 * @method static \CakeDC\Money\Money STN(string|int $amount) See \Money\MoneyFactory::STN()
 * @method static \CakeDC\Money\Money SVC(string|int $amount) See \Money\MoneyFactory::SVC()
 * @method static \CakeDC\Money\Money SYP(string|int $amount) See \Money\MoneyFactory::SYP()
 * @method static \CakeDC\Money\Money SZL(string|int $amount) See \Money\MoneyFactory::SZL()
 * @method static \CakeDC\Money\Money THB(string|int $amount) See \Money\MoneyFactory::THB()
 * @method static \CakeDC\Money\Money TJS(string|int $amount) See \Money\MoneyFactory::TJS()
 * @method static \CakeDC\Money\Money TMT(string|int $amount) See \Money\MoneyFactory::TMT()
 * @method static \CakeDC\Money\Money TND(string|int $amount) See \Money\MoneyFactory::TND()
 * @method static \CakeDC\Money\Money TOP(string|int $amount) See \Money\MoneyFactory::TOP()
 * @method static \CakeDC\Money\Money TRY(string|int $amount) See \Money\MoneyFactory::TRY()
 * @method static \CakeDC\Money\Money TTD(string|int $amount) See \Money\MoneyFactory::TTD()
 * @method static \CakeDC\Money\Money TWD(string|int $amount) See \Money\MoneyFactory::TWD()
 * @method static \CakeDC\Money\Money TZS(string|int $amount) See \Money\MoneyFactory::TZS()
 * @method static \CakeDC\Money\Money UAH(string|int $amount) See \Money\MoneyFactory::UAH()
 * @method static \CakeDC\Money\Money UGX(string|int $amount) See \Money\MoneyFactory::UGX()
 * @method static \CakeDC\Money\Money USD(string|int $amount) See \Money\MoneyFactory::USD()
 * @method static \CakeDC\Money\Money USN(string|int $amount) See \Money\MoneyFactory::USN()
 * @method static \CakeDC\Money\Money UYI(string|int $amount) See \Money\MoneyFactory::UYI()
 * @method static \CakeDC\Money\Money UYU(string|int $amount) See \Money\MoneyFactory::UYU()
 * @method static \CakeDC\Money\Money UYW(string|int $amount) See \Money\MoneyFactory::UYW()
 * @method static \CakeDC\Money\Money UZS(string|int $amount) See \Money\MoneyFactory::UZS()
 * @method static \CakeDC\Money\Money VES(string|int $amount) See \Money\MoneyFactory::VES()
 * @method static \CakeDC\Money\Money VND(string|int $amount) See \Money\MoneyFactory::VND()
 * @method static \CakeDC\Money\Money VUV(string|int $amount) See \Money\MoneyFactory::VUV()
 * @method static \CakeDC\Money\Money WST(string|int $amount) See \Money\MoneyFactory::WST()
 * @method static \CakeDC\Money\Money XAF(string|int $amount) See \Money\MoneyFactory::XAF()
 * @method static \CakeDC\Money\Money XAG(string|int $amount) See \Money\MoneyFactory::XAG()
 * @method static \CakeDC\Money\Money XAU(string|int $amount) See \Money\MoneyFactory::XAU()
 * @method static \CakeDC\Money\Money XBA(string|int $amount) See \Money\MoneyFactory::XBA()
 * @method static \CakeDC\Money\Money XBB(string|int $amount) See \Money\MoneyFactory::XBB()
 * @method static \CakeDC\Money\Money XBC(string|int $amount) See \Money\MoneyFactory::XBC()
 * @method static \CakeDC\Money\Money XBD(string|int $amount) See \Money\MoneyFactory::XBD()
 * @method static \CakeDC\Money\Money XBT(string|int $amount) See \Money\MoneyFactory::XBT()
 * @method static \CakeDC\Money\Money XCD(string|int $amount) See \Money\MoneyFactory::XCD()
 * @method static \CakeDC\Money\Money XDR(string|int $amount) See \Money\MoneyFactory::XDR()
 * @method static \CakeDC\Money\Money XOF(string|int $amount) See \Money\MoneyFactory::XOF()
 * @method static \CakeDC\Money\Money XPD(string|int $amount) See \Money\MoneyFactory::XPD()
 * @method static \CakeDC\Money\Money XPF(string|int $amount) See \Money\MoneyFactory::XPF()
 * @method static \CakeDC\Money\Money XPT(string|int $amount) See \Money\MoneyFactory::XPT()
 * @method static \CakeDC\Money\Money XSU(string|int $amount) See \Money\MoneyFactory::XSU()
 * @method static \CakeDC\Money\Money XTS(string|int $amount) See \Money\MoneyFactory::XTS()
 * @method static \CakeDC\Money\Money XUA(string|int $amount) See \Money\MoneyFactory::XUA()
 * @method static \CakeDC\Money\Money XXX(string|int $amount) See \Money\MoneyFactory::XXX()
 * @method static \CakeDC\Money\Money YER(string|int $amount) See \Money\MoneyFactory::YER()
 * @method static \CakeDC\Money\Money ZAR(string|int $amount) See \Money\MoneyFactory::ZAR()
 * @method static \CakeDC\Money\Money ZMW(string|int $amount) See \Money\MoneyFactory::ZMW()
 * @method static \CakeDC\Money\Money ZWL(string|int $amount) See \Money\MoneyFactory::ZWL()
 * @see \Money\Money
 * @package CakeDC\Money
 */
class Money
{
    public const ROUND_HALF_UP = PHP_ROUND_HALF_UP;

    public const ROUND_HALF_DOWN = PHP_ROUND_HALF_DOWN;

    public const ROUND_HALF_EVEN = PHP_ROUND_HALF_EVEN;

    public const ROUND_HALF_ODD = PHP_ROUND_HALF_ODD;

    public const ROUND_UP = 5;

    public const ROUND_DOWN = 6;

    public const ROUND_HALF_POSITIVE_INFINITY = 7;

    public const ROUND_HALF_NEGATIVE_INFINITY = 8;

    /**
     * @var \Money\Money
     */
    protected MoneyPHP $_money;

    /**
     * @return \Money\Money
     */
    public function getMoney(): MoneyPHP
    {
        return $this->_money;
    }

    /**
     * Constructor
     *
     * @param \Money\Money $money
     */
    public function __construct(MoneyPHP $money)
    {
        $this->_money = $money;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed|false
     */
    public function __call(string $name, array $arguments): mixed
    {
        $arguments = self::processArguments($arguments);
        // @phpstan-ignore-next-line
        $result = call_user_func_array([$this->_money, $name], $arguments);
        if ($result instanceof MoneyPHP) {
            return new self($result);
        }

        return $result;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed|false
     */
    public static function __callStatic(string $name, array $arguments): mixed
    {
        $arguments = self::processArguments($arguments);

        // @phpstan-ignore-next-line
        return new self(forward_static_call_array([MoneyPHP::class, $name], $arguments));
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return MoneyUtil::format($this);
    }

    /**
     * @param array $arguments
     * @return array
     */
    protected static function processArguments(array $arguments = []): array
    {
        $count = count($arguments);
        for ($i = 0; $i < $count; $i++) {
            if ($arguments[$i] instanceof Money) {
                $arguments[$i] = $arguments[$i]->getMoney();
            }
        }

        return $arguments;
    }
}
