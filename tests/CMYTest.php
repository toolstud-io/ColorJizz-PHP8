<?php

use MischiefCollective\ColorJizz\Formats\CMY;
use PHPUnit\Framework\TestCase;

class CMYTest extends TestCase
{
    const DELTA = 0.002;

    /**
     * @covers \MischiefCollective\ColorJizz\Formats\CMY
     */
    public function testToHexAndBack(): void
    {
        for ($c = 0; $c <= 1; $c += 0.1) {
            for ($m = 0; $m <= 1; $m += 0.1) {
                for ($y = 0; $y <= 1; $y += 0.1) {
                    $cmy = CMY::create($c, $m, $y)->toHex()->toCMY();
                    $this->assertEqualsWithDelta($c, $cmy->getCyan(), self::DELTA, __CLASS__ . "Cyan");
                    $this->assertEqualsWithDelta($m, $cmy->getMagenta(), self::DELTA, __CLASS__ . "Magenta");
                    $this->assertEqualsWithDelta($y, $cmy->getYellow(), self::DELTA, __CLASS__ . "Yellow");
                }
            }
        }
    }

    /**
     * @covers \MischiefCollective\ColorJizz\Formats\CMY
     */
    public function testToRGBAndBack()
    {
        for ($c = 0; $c <= 1; $c += 0.1) {
            for ($m = 0; $m <= 1; $m += 0.1) {
                for ($y = 0; $y <= 1; $y += 0.1) {
                    $cmy = CMY::create($c, $m, $y)->toRGB()->toCMY();
                    $this->assertEqualsWithDelta($c, $cmy->getCyan(), self::DELTA, __CLASS__ . "Cyan");
                    $this->assertEqualsWithDelta($m, $cmy->getMagenta(), self::DELTA, __CLASS__ . "Magenta");
                    $this->assertEqualsWithDelta($y, $cmy->getYellow(), self::DELTA, __CLASS__ . "Yellow");
                }
            }
        }
    }

    /**
     * @covers \MischiefCollective\ColorJizz\Formats\CMY
     */
    public function testToXYZAndBack()
    {
        for ($c = 0; $c <= 1; $c += 0.1) {
            for ($m = 0; $m <= 1; $m += 0.1) {
                for ($y = 0; $y <= 1; $y += 0.1) {
                    $cmy = CMY::create($c, $m, $y)->toXYZ()->toCMY();
                    $this->assertEqualsWithDelta($c, $cmy->getCyan(), self::DELTA, __CLASS__ . "Cyan");
                    $this->assertEqualsWithDelta($m, $cmy->getMagenta(), self::DELTA, __CLASS__ . "Magenta");
                    $this->assertEqualsWithDelta($y, $cmy->getYellow(), self::DELTA, __CLASS__ . "Yellow");
                }
            }
        }
    }

    /**
     * @covers \MischiefCollective\ColorJizz\Formats\CMY
     */
    public function testToCMYKAndBack()
    {
        for ($c = 0; $c <= 1; $c += 0.1) {
            for ($m = 0; $m <= 1; $m += 0.1) {
                for ($y = 0; $y <= 1; $y += 0.1) {
                    $cmy = CMY::create($c, $m, $y)->toCMYK()->toCMY();
                    $this->assertEqualsWithDelta($c, $cmy->getCyan(), self::DELTA, __CLASS__ . "Cyan");
                    $this->assertEqualsWithDelta($m, $cmy->getMagenta(), self::DELTA, __CLASS__ . "Magenta");
                    $this->assertEqualsWithDelta($y, $cmy->getYellow(), self::DELTA, __CLASS__ . "Yellow");
                }
            }
        }
    }

    /**
     * @covers \MischiefCollective\ColorJizz\Formats\CMY
     */
    public function testToYxyAndBack()
    {
        for ($c = 0; $c <= 1; $c += 0.1) {
            for ($m = 0; $m <= 1; $m += 0.1) {
                for ($y = 0; $y <= 1; $y += 0.1) {
                    $cmy = CMY::create($c, $m, $y)->toYxy()->toCMY();
                    $this->assertEqualsWithDelta($c, $cmy->getCyan(), self::DELTA, __CLASS__ . "Cyan");
                    $this->assertEqualsWithDelta($m, $cmy->getMagenta(), self::DELTA, __CLASS__ . "Magenta");
                    $this->assertEqualsWithDelta($y, $cmy->getYellow(), self::DELTA, __CLASS__ . "Yellow");
                }
            }
        }
    }

    /**
     * @covers \MischiefCollective\ColorJizz\Formats\CMY
     */
    public function testToCIELabAndBack()
    {
        for ($c = 0; $c <= 1; $c += 0.1) {
            for ($m = 0; $m <= 1; $m += 0.1) {
                for ($y = 0; $y <= 1; $y += 0.1) {
                    $cmy = CMY::create($c, $m, $y)->toCIELab()->toCMY();
                    $this->assertEqualsWithDelta($c, $cmy->getCyan(), self::DELTA, __CLASS__ . "Cyan");
                    $this->assertEqualsWithDelta($m, $cmy->getMagenta(), self::DELTA, __CLASS__ . "Magenta");
                    $this->assertEqualsWithDelta($y, $cmy->getYellow(), self::DELTA, __CLASS__ . "Yellow");
                }
            }
        }
    }

    /**
     * @covers \MischiefCollective\ColorJizz\Formats\CMY
     */
    public function testToCIELChAndBack()
    {
        for ($c = 0; $c <= 1; $c += 0.1) {
            for ($m = 0; $m <= 1; $m += 0.1) {
                for ($y = 0; $y <= 1; $y += 0.1) {
                    $cmy = CMY::create($c, $m, $y)->toCIELCh()->toCMY();
                    $this->assertEqualsWithDelta($c, $cmy->getCyan(), self::DELTA, __CLASS__ . "Cyan");
                    $this->assertEqualsWithDelta($m, $cmy->getMagenta(), self::DELTA, __CLASS__ . "Magenta");
                    $this->assertEqualsWithDelta($y, $cmy->getYellow(), self::DELTA, __CLASS__ . "Yellow");
                }
            }
        }
    }

    /**
     * @covers \MischiefCollective\ColorJizz\Formats\CMY
     */
    public function testToHSVAndBack()
    {
        for ($c = 0; $c <= 1; $c += 0.1) {
            for ($m = 0; $m <= 1; $m += 0.1) {
                for ($y = 0; $y <= 1; $y += 0.1) {
                    $cmy = CMY::create($c, $m, $y)->toHSV()->toCMY();
                    $this->assertEqualsWithDelta($c, $cmy->getCyan(), self::DELTA, __CLASS__ . "Cyan");
                    $this->assertEqualsWithDelta($m, $cmy->getMagenta(), self::DELTA, __CLASS__ . "Magenta");
                    $this->assertEqualsWithDelta($y, $cmy->getYellow(), self::DELTA, __CLASS__ . "Yellow");
                }
            }
        }
    }

    /**
     * @covers \MischiefCollective\ColorJizz\Formats\CMY
     */
    public function testToHSLAndBack()
    {
        for ($c = 0; $c <= 1; $c += 0.1) {
            for ($m = 0; $m <= 1; $m += 0.1) {
                for ($y = 0; $y <= 1; $y += 0.1) {
                    $cmy = CMY::create($c, $m, $y)->toHSL()->toCMY();
                    $this->assertEqualsWithDelta($c, $cmy->getCyan(), self::DELTA, __CLASS__ . "Cyan");
                    $this->assertEqualsWithDelta($m, $cmy->getMagenta(), self::DELTA, __CLASS__ . "Magenta");
                    $this->assertEqualsWithDelta($y, $cmy->getYellow(), self::DELTA, __CLASS__ . "Yellow");
                }
            }
        }
    }
}
