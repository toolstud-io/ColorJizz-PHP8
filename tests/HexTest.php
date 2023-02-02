<?php

use MischiefCollective\ColorJizz\Exceptions\InvalidArgumentException;
use MischiefCollective\ColorJizz\Formats\Hex;
use PHPUnit\Framework\TestCase;

class HexTest extends TestCase
{
    /**
     * @throws InvalidArgumentException
     * @covers \MischiefCollective\ColorJizz\Formats\Hex
     */
    public function testFromString()
    {
        $this->assertEquals(0xDB09E4, Hex::fromString('DB09e4')->hex);
        $this->assertEquals(0x487453, Hex::fromString('487453')->hex);
        $this->assertEquals(0x36F6F6, Hex::fromString('36f6F6')->hex);
        $this->assertEquals(0xFE5006, Hex::fromString('fE5006')->hex);
        $this->assertEquals(0x41EB55, Hex::fromString('41eb55')->hex);
        $this->assertEquals(0x686639, Hex::fromString('686639')->hex);
        $this->assertEquals(0x222B65, Hex::fromString('222B65')->hex);

        $this->assertEquals(0x000000, Hex::fromString('000000')->hex);
        $this->assertEquals(0xFFFFFF, Hex::fromString('FfFfFf')->hex);

        $this->assertEquals(0x000000, Hex::fromString('#000000')->hex);
        $this->assertEquals(0xFFFFFF, Hex::fromString('#fFf')->hex);

        $this->assertEquals(0x000000, Hex::fromString('black')->hex);
        $this->assertEquals(0x000000, Hex::fromString('BLAck')->hex);
        $this->assertEquals(0xFF0000, Hex::fromString('red')->hex);
    }

    /**
     * @covers \MischiefCollective\ColorJizz\Formats\Hex
     */
    public function testInvalidColorNameException()
    {
        $this->expectException(MischiefCollective\ColorJizz\Exceptions\InvalidArgumentException::class);
        Hex::fromString('black-');
    }

    /**
     * @covers \MischiefCollective\ColorJizz\Formats\Hex
     */
    public function testInvalidHexValueException()
    {
        $this->expectException(MischiefCollective\ColorJizz\Exceptions\InvalidArgumentException::class);
        Hex::fromString('#0FW');
    }

    /**
     * @covers \MischiefCollective\ColorJizz\Formats\Hex
     */
    public function testMalformedHexValueException()
    {
        $this->expectException(MischiefCollective\ColorJizz\Exceptions\InvalidArgumentException::class);
        Hex::fromString('# 0FW');
    }

    /**
     * @return void
     * @covers \MischiefCollective\ColorJizz\Formats\Hex
     */
    public function testToString(): void
    {
        $this->assertEquals('DACDD3', Hex::create(0xDACDD3)->__toString());
        $this->assertEquals('8207D7', Hex::create(0x8207D7)->__toString());
        $this->assertEquals('1F66D9', Hex::create(0x1F66D9)->__toString());
        $this->assertEquals('FEE158', Hex::create(0xFEE158)->__toString());
        $this->assertEquals('313258', Hex::create(0x313258)->__toString());
        $this->assertEquals('572F84', Hex::create(0x572F84)->__toString());
        $this->assertEquals('6474C2', Hex::create(0x6474C2)->__toString());
        $this->assertEquals('E406AE', Hex::create(0xE406AE)->__toString());
        $this->assertEquals('EB613D', Hex::create(0xEB613D)->__toString());

        $this->assertEquals('FFFFFF', Hex::create(0xFFFFFF)->__toString());
        $this->assertEquals('000000', Hex::create(0x000000)->__toString());
    }

    /**
     * @return void
     * @covers \MischiefCollective\ColorJizz\Formats\Hex
     */
    public function testToRGBAndBack(): void
    {
        for ($i = 0; $i <= 0xFFFFFF; $i += 0x0CCCCC) {
            $this->assertEquals($i, Hex::create($i)->toRGB()->toHex()->hex);
        }
    }

    /**
     * @return void
     * @covers \MischiefCollective\ColorJizz\Formats\Hex
     */
    public function testToXYZAndBack(): void
    {
        for ($i = 0; $i <= 0xFFFFFF; $i += 0x0CCCCC) {
            $this->assertEquals($i, Hex::create($i)->toXYZ()->toHex()->hex);
        }
    }

    /**
     * @return void
     * @covers \MischiefCollective\ColorJizz\Formats\Hex
     */
    public function testToCMYAndBack(): void
    {
        for ($i = 0; $i <= 0xFFFFFF; $i += 0x0CCCCC) {
            $this->assertEquals($i, Hex::create($i)->toCMY()->toHex()->hex);
        }
    }

    /**
     * @return void
     * @covers \MischiefCollective\ColorJizz\Formats\Hex
     */
    public function testToCMYKAndBack(): void
    {
        for ($i = 0; $i <= 0xFFFFFF; $i += 0x0CCCCC) {
            $this->assertEquals($i, Hex::create($i)->toCMYK()->toHex()->hex);
        }
    }

    /**
     * @return void
     * @covers \MischiefCollective\ColorJizz\Formats\Hex
     */
    public function testToYxyAndBack(): void
    {
        for ($i = 0; $i <= 0xFFFFFF; $i += 0x0CCCCC) {
            $this->assertEquals($i, Hex::create($i)->toYxy()->toHex()->hex);
        }
    }

    /**
     * @return void
     * @covers \MischiefCollective\ColorJizz\Formats\Hex
     */
    public function testToCIELabAndBack(): void
    {
        for ($i = 0; $i <= 0xFFFFFF; $i += 0x0CCCCC) {
            $this->assertEquals($i, Hex::create($i)->toCIELab()->toHex()->hex);
        }
    }

    /**
     * @return void
     * @covers \MischiefCollective\ColorJizz\Formats\Hex
     */
    public function testToCIELChAndBack(): void
    {
        for ($i = 0; $i <= 0xFFFFFF; $i += 0x0CCCCC) {
            $this->assertEquals($i, Hex::create($i)->toCIELCh()->toHex()->hex);
        }
    }

    /**
     * @return void
     * @covers \MischiefCollective\ColorJizz\Formats\Hex
     */
    public function testToHSVAndBack(): void
    {
        for ($i = 0; $i <= 0xFFFFFF; $i += 0x0CCCCC) {
            $this->assertEquals($i, Hex::create($i)->toHSV()->toHex()->hex);
        }
    }

    /**
     * @return void
     * @covers \MischiefCollective\ColorJizz\Formats\Hex
     */
    public function testToHSLAndBack(): void
    {
        for ($i = 0; $i <= 0xFFFFFF; $i += 0x0CCCCC) {
            $this->assertEquals($i, Hex::create($i)->toHSL()->toHex()->hex);
        }
    }
}
