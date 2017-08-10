<?php
/**
 * Created by PhpStorm.
 * User: enesdayanc
 * Date: 10/08/2017
 * Time: 09:57
 */

namespace Enesdayanc\Iso4217;

use Enesdayanc\Iso4217\Model\Currency;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

class Iso4217Test extends TestCase
{
    /** @var  Iso4217 $iso4217 */
    protected $iso4217;

    public function setUp()
    {
        $this->iso4217 = new Iso4217();
    }

    public function testCanBeGetByCodeAlpha3()
    {
        $response = $this->iso4217->getByCode('TRY');

        $this->assertInstanceOf(Currency::class, $response);
        $this->assertSame('TRY', $response->getAlpha3());
        $this->assertSame('Turkish Lira', $response->getName());
        $this->assertSame('949', $response->getNumeric());
    }


    public function testCanBeGetByCodeNumeric()
    {
        $response = $this->iso4217->getByCode('949');

        $this->assertInstanceOf(Currency::class, $response);
        $this->assertSame('TRY', $response->getAlpha3());
        $this->assertSame('Turkish Lira', $response->getName());
        $this->assertSame('949', $response->getNumeric());
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
        $response = $this->iso4217->getByAlpha3('TRY');

        $this->assertInstanceOf(Currency::class, $response);
        $this->assertSame('TRY', $response->getAlpha3());
        $this->assertSame('Turkish Lira', $response->getName());
        $this->assertSame('949', $response->getNumeric());
    }

    public function testCanBeGetByAlpha3Error()
    {
        $this->expectException(OutOfBoundsException::class);

        $this->iso4217->getByCode('ZZZ');
    }


    public function testCanBeGetByNumeric()
    {
        $response = $this->iso4217->getByNumeric('949');

        $this->assertInstanceOf(Currency::class, $response);
        $this->assertSame('TRY', $response->getAlpha3());
        $this->assertSame('Turkish Lira', $response->getName());
        $this->assertSame('949', $response->getNumeric());
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