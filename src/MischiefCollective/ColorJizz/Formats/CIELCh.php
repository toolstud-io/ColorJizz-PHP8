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
 * CIELCh represents the CIELCh color format.
 *
 *
 * @author Mikee Franklin <mikeefranklin@gmail.com>
 */
class CIELCh extends ColorJizz
{
    /**
     * The lightness.
     * @var float
     */
    public float $lightness;

    /**
     * The chroma.
     * @var float
     */
    public float $chroma;

    /**
     * The hue.
     * @var float
     */
    public float $hue;

    /**
     * Create a new CIELCh color.
     *
     * @param float $lightness The lightness
     * @param float $chroma The chroma
     * @param float $hue The hue
     */
    public function __construct(float $lightness, float $chroma, float $hue)
    {
        $this->toSelf = 'toCIELCh';
        $this->lightness = $lightness;
        $this->chroma = $chroma;
        $this->hue = fmod($hue, 360);
        if ($this->hue < 0) {
            $this->hue += 360;
        }
    }

    /**
     * Convert the color to Hex format.
     *
     * @return Hex the color in Hex format
     * @throws InvalidArgumentException
     */
    public function toHex(): Hex
    {
        return $this->toCIELab()->toHex();
    }

    /**
     * Convert the color to RGB format.
     *
     * @return RGB the color in RGB format
     * @throws InvalidArgumentException
     */
    public function toRGB(): RGB
    {
        return $this->toCIELab()->toRGB();
    }

    /**
     * Convert the color to XYZ format.
     *
     * @return XYZ the color in XYZ format
     */
    public function toXYZ(): XYZ
    {
        return $this->toCIELab()->toXYZ();
    }

    /**
     * Convert the color to Yxy format.
     *
     * @return Yxy the color in Yxy format
     */
    public function toYxy(): Yxy
    {
        return $this->toXYZ()->toYxy();
    }

    /**
     * Convert the color to HSL format.
     *
     * @return HSL the color in HSL format
     * @throws InvalidArgumentException
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
        return $this->toCIELab()->toHSV();
    }

    /**
     * Convert the color to CMY format.
     *
     * @return CMY the color in CMY format
     * @throws InvalidArgumentException
     */
    public function toCMY(): CMY
    {
        return $this->toCIELab()->toCMY();
    }

    /**
     * Convert the color to CMYK format.
     *
     * @return CMYK the color in CMYK format
     * @throws InvalidArgumentException
     */
    public function toCMYK(): CMYK
    {
        return $this->toCIELab()->toCMYK();
    }

    /**
     * Convert the color to CIELab format.
     *
     * @return CIELab the color in CIELab format
     */
    public function toCIELab(): CIELab
    {
        $hueRadials = $this->hue * (pi() / 180);
        $a_dimension = cos($hueRadials) * $this->chroma;
        $b_dimension = sin($hueRadials) * $this->chroma;

        return new CIELab($this->lightness, $a_dimension, $b_dimension);
    }

    /**
     * Convert the color to CIELCh format.
     *
     * @return CIELCh the color in CIELCh format
     */
    public function toCIELCh(): static
    {
        return $this;
    }

    /**
     * A string representation of this color in the current format.
     *
     * @return string The color in format: $lightness,$chroma,$hue
     */
    public function __toString(): string
    {
        return sprintf('%01.4f, %01.4f, %01.4f', $this->lightness, $this->chroma, $this->hue);
    }
}
