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
 * Yxy represents the Yxy color format.
 *
 *
 * @author Mikee Franklin <mikeefranklin@gmail.com>
 */
class Yxy extends ColorJizz
{
    /**
     * The Y.
     * @var float
     */
    public float $Y;

    /**
     * The x.
     * @var float
     */
    public float $x;

    /**
     * The y.
     * @var float
     */
    public float $y;

    /**
     * Create a new Yxy color.
     *
     * @param float $Y The Y
     * @param float $x The x
     * @param float $y The y
     */
    public function __construct(float $Y, float $x, float $y)
    {
        $this->toSelf = 'toYxy';
        $this->Y = $Y;
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Convert the color to Hex format.
     *
     * @return Hex the color in Hex format
     * @throws InvalidArgumentException
     */
    public function toHex(): Hex
    {
        return $this->toXYZ()->toRGB()->toHex();
    }

    /**
     * Convert the color to RGB format.
     *
     * @return RGB the color in RGB format
     * @throws InvalidArgumentException
     */
    public function toRGB(): RGB
    {
        return $this->toXYZ()->toRGB();
    }

    /**
     * Convert the color to XYZ format.
     *
     * @return XYZ the color in XYZ format
     */
    public function toXYZ(): XYZ
    {
        $X = ($this->Y == 0) ? 0 : $this->x * ($this->Y / $this->y);
        $Y = $this->Y;
        $Z = ($this->Y == 0) ? 0 : (1 - $this->x - $this->y) * ($this->Y / $this->y);

        return new XYZ($X, $Y, $Z);
    }

    /**
     * Convert the color to Yxy format.
     *
     * @return Yxy the color in Yxy format
     */
    public function toYxy(): static
    {
        return $this;
    }

    /**
     * Convert the color to HSL format.
     *
     * @return HSL the color in HSL format
     */
    public function toHSL(): HSL
    {
        return $this->toHSV()->toHSL();
    }

    /**
     * Convert the color to HSV format.
     *
     * @return HSV the color in HSV format
     * @throws InvalidArgumentException
     */
    public function toHSV(): HSV
    {
        return $this->toXYZ()->toHSV();
    }

    /**
     * Convert the color to CMY format.
     *
     * @return CMY the color in CMY format
     * @throws InvalidArgumentException
     */
    public function toCMY(): CMY
    {
        return $this->toXYZ()->toCMY();
    }

    /**
     * Convert the color to CMYK format.
     *
     * @return CMYK the color in CMYK format
     * @throws InvalidArgumentException
     */
    public function toCMYK(): CMYK
    {
        return $this->toXYZ()->toCMYK();
    }

    /**
     * Convert the color to CIELab format.
     *
     * @return CIELab the color in CIELab format
     */
    public function toCIELab(): CIELab
    {
        return $this->toXYZ()->toCIELab();
    }

    /**
     * Convert the color to CIELCh format.
     *
     * @return CIELCh the color in CIELCh format
     */
    public function toCIELCh(): CIELCh
    {
        return $this->toXYZ()->toCIELCh();
    }

    /**
     * A string representation of this color in the current format.
     *
     * @return string The color in format: $Y,$x,$y
     */
    public function __toString(): string
    {
        return sprintf('%01.4f, %01.4f, %01.4f', $this->Y, $this->x, $this->y);
    }
}
