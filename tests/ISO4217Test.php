<?php
/**
 * Created by PhpStorm.
 * User: enesdayanc
 * Date: 10/08/2017
 * Time: 09:57
 */

namespace PaymentGateway\ISO4217;

use PaymentGateway\ISO4217\Model\Currency;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

class ISO4217Test extends TestCase
{
    const CURRENCY_ALPHA3 = 'TRY';
    const CURRENCY_NAME = 'Turkish Lira';
    const CURRENCY_NUMERIC = '949';

    /** @var  ISO4217 $iso4217 */
    protected $iso4217;

    public function setUp()
    {
        $this->iso4217 = new ISO4217();
    }

    public function testCanBeGetByCodeAlpha3()
    {
        $response = $this->iso4217->getByCode(self::CURRENCY_ALPHA3);

        $this->assertInstanceOf(Currency::class, $response);
        $this->assertSame(self::CURRENCY_ALPHA3, $response->getAlpha3());
        $this->assertSame(self::CURRENCY_NAME, $response->getName());
        $this->assertSame(self::CURRENCY_NUMERIC, $response->getNumeric());
    }


    public function testCanBeGetByCodeNumeric()
    {
        $response = $this->iso4217->getByCode(self::CURRENCY_NUMERIC);

        $this->assertInstanceOf(Currency::class, $response);
        $this->assertSame(self::CURRENCY_ALPHA3, $response->getAlpha3());
        $this->assertSame(self::CURRENCY_NAME, $response->getName());
        $this->assertSame(self::CURRENCY_NUMERIC, $response->getNumeric());
    }

    public function testCanBeGetByCodeAlpha3Error()
    {
        $this->expectException(OutOfBoundsException::class);

        $this->iso4217->getByCode('ZZZ');
    }

    public function testCanBeGetByCodeNumericError()
    {
        $this->expectException(OutOfBoundsException::class);

        $this->iso4217->getByCode('000');
    }


    public function testCanBeGetByAlpha3()
    {
        $response = $this->iso4217->getByAlpha3(self::CURRENCY_ALPHA3);

        $this->assertInstanceOf(Currency::class, $response);
        $this->assertSame(self::CURRENCY_ALPHA3, $response->getAlpha3());
        $this->assertSame(self::CURRENCY_NAME, $response->getName());
        $this->assertSame(self::CURRENCY_NUMERIC, $response->getNumeric());
    }

    public function testCanBeGetByAlpha3Error()
    {
        $this->expectException(OutOfBoundsException::class);

        $this->iso4217->getByCode('ZZZ');
    }


    public function testCanBeGetByNumeric()
    {
        $response = $this->iso4217->getByNumeric(self::CURRENCY_NUMERIC);

        $this->assertInstanceOf(Currency::class, $response);
        $this->assertSame(self::CURRENCY_ALPHA3, $response->getAlpha3());
        $this->assertSame(self::CURRENCY_NAME, $response->getName());
        $this->assertSame(self::CURRENCY_NUMERIC, $response->getNumeric());
    }

    public function testCanBeGetByNumericError()
    {
        $this->expectException(OutOfBoundsException::class);

        $this->iso4217->getByCode('000');
    }

    public function testCanBeGetAll()
    {
        $response = $this->iso4217->getAll();

        $this->assertInternalType('array', $response);
    }
}