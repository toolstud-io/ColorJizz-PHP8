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
 * HSV represents the HSV color format.
 *
 *
 * @author Mikee Franklin <mikeefranklin@gmail.com>
 */
class HSV extends ColorJizz
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
     * The value.
     * @var float
     */
    public float $value;

    /**
     * Create a new HSV color.
     *
     * @param float $hue The hue (0-1)
     * @param float $saturation The saturation (0-1)
     * @param float $value The value (0-1)
     */
    public function __construct(float $hue, float $saturation, float $value)
    {
        $this->toSelf = 'toHSV';
        $this->hue = $hue;
        $this->saturation = $saturation;
        $this->value = $value;
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
        $hue = $this->hue / 360;
        $saturation = $this->saturation / 100;
        $value = $this->value / 100;
        if ($saturation == 0) {
            $red = $value * 255;
            $green = $value * 255;
            $blue = $value * 255;
        } else {
            $var_h = $hue * 6;
            $var_i = floor($var_h);
            $var_1 = $value * (1 - $saturation);
            $var_2 = $value * (1 - $saturation * ($var_h - $var_i));
            $var_3 = $value * (1 - $saturation * (1 - ($var_h - $var_i)));

            if ($var_i == 0) {
                $var_r = $value;
                $var_g = $var_3;
                $var_b = $var_1;
            } elseif ($var_i == 1) {
                $var_r = $var_2;
                $var_g = $value;
                $var_b = $var_1;
            } elseif ($var_i == 2) {
                $var_r = $var_1;
                $var_g = $value;
                $var_b = $var_3;
            } elseif ($var_i == 3) {
                $var_r = $var_1;
                $var_g = $var_2;
                $var_b = $value;
            } else {
                if ($var_i == 4) {
                    $var_r = $var_3;
                    $var_g = $var_1;
                    $var_b = $value;
                } else {
                    $var_r = $value;
                    $var_g = $var_1;
                    $var_b = $var_2;
                }
            }

            $red = round($var_r * 255);
            $green = round($var_g * 255);
            $blue = round($var_b * 255);
        }

        return new RGB($red, $green, $blue);
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
    public function toHSL(): HSL
    {
        $h = $this->hue;
        $l = (2 - $this->saturation / 100) * $this->value / 2;
        $s = ($l > 0 && $l < 100)
            ? $this->saturation * $this->value / ($l < 50 ? $l * 2 : 200 - $l * 2)
            : 0;

        return new HSL($h, $s, $l);
    }

    /**
     * Convert the color to HSV format.
     *
     * @return HSV the color in HSV format
     */
    public function toHSV(): static
    {
        return $this;
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
     * @return string The color in format: $hue,$saturation,$value
     */
    public function __toString(): string
    {
        return sprintf('%01.4f, %01.4f, %01.4f', $this->hue, $this->saturation, $this->value);
    }
}
