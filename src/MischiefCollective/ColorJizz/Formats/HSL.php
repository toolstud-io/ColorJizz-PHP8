<?php

/*
 * This file is part of the ColorJizz package.
 *
 * (c) Mikee Franklin <mikeefranklin@gmail.com>
 *
 */

namespace MischiefCollective\ColorJizz\Formats;

use MischiefCollective\ColorJizz\ColorJizz;
use MischiefCollective\ColorJizz\Exceptions\InvalidArgumentException;

/**
 * HSL represents the HSL color format.
 *
 *
 * @author Drake Parker <e.drake.p@gmail.com>
 */
class HSL extends ColorJizz
{
    /**
     * The hue.
     * @var float
     */
    public float $hue;

    /**
     * The saturation.
     * @var float
     */
    public float $saturation;

    /**
     * The lightness.
     * @var float
     */
    public float $lightness;

    /**
     * Create a new HSL color.
     *
     * @param float $hue The hue (0-1)
     * @param float $saturation The saturation (0-1)
     * @param float $lightness The lightness (0-1)
     */
    public function __construct(float $hue, float $saturation, float $lightness)
    {
        $this->toSelf = 'toHSL';
        $this->hue = $hue;
        $this->saturation = $saturation;
        $this->lightness = $lightness;
    }

    /**
     * Convert the color to Hex format.
     *
     * @return Hex the color in Hex format
     * @throws InvalidArgumentException
     */
    public function toHex(): Hex
    {
        return $this->toRGB()->toHex();
    }

    /**
     * Convert the color to RGB format.
     *
     * @return RGB the color in RGB format
     * @throws InvalidArgumentException
     */
    public function toRGB(): RGB
    {
        return $this->toHSV()->toRGB();
    }

    /**
     * Convert the color to XYZ format.
     *
     * @return XYZ the color in XYZ format
     * @throws InvalidArgumentException
     */
    public function toXYZ(): XYZ
    {
        return $this->toRGB()->toXYZ();
    }

    /**
     * Convert the color to Yxy format.
     *
     * @return Yxy the color in Yxy format
     * @throws InvalidArgumentException
     */
    public function toYxy(): Yxy
    {
        return $this->toXYZ()->toYxy();
    }

    /**
     * Convert the color to HSL format.
     *
     * @return HSL the color in HSL format
     */
    public function toHSL(): static
    {
        return $this;
    }

    /**
     * Convert the color to HSV format.
     *
     * @return HSV the color in HSV format
     */
    public function toHSV(): HSV
    {
        $temp = $this->saturation * ($this->lightness < 50 ? $this->lightness : 100 - $this->lightness) / 100;

        $h = $this->hue;
        $v = $temp + $this->lightness;
        $s = ($this->lightness + $temp > 0)
            ? 200 * $temp / ($this->lightness + $temp)
            : 0;

        return new HSV($h, $s, $v);
    }

    /**
     * Convert the color to CMY format.
     *
     * @return CMY the color in CMY format
     * @throws InvalidArgumentException
     */
    public function toCMY(): CMY
    {
        return $this->toRGB()->toCMY();
    }

    /**
     * Convert the color to CMYK format.
     *
     * @return CMYK the color in CMYK format
     * @throws InvalidArgumentException
     */
    public function toCMYK(): CMYK
    {
        return $this->toCMY()->toCMYK();
    }

    /**
     * Convert the color to CIELab format.
     *
     * @return CIELab the color in CIELab format
     * @throws InvalidArgumentException
     */
    public function toCIELab(): CIELab
    {
        return $this->toRGB()->toCIELab();
    }

    /**
     * Convert the color to CIELCh format.
     *
     * @return CIELCh the color in CIELCh format
     * @throws InvalidArgumentException
     */
    public function toCIELCh(): CIELCh
    {
        return $this->toCIELab()->toCIELCh();
    }

    /**
     * A string representation of this color in the current format.
     *
     * @return string The color in format: $hue,$saturation,$lightness
     */
    public function __toString(): string
    {
        return sprintf('%01.4f, %01.4f, %01.4f', $this->hue, $this->saturation, $this->lightness);
    }
}
