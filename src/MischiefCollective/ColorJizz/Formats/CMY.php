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
 * CMY represents the CMY color format.
 *
 *
 * @author Mikee Franklin <mikeefranklin@gmail.com>
 */
class CMY extends ColorJizz
{
    /**
     * The cyan.
     * @var float
     */
    private float $cyan;

    /**
     * The magenta.
     * @var float
     */
    private float $magenta;

    /**
     * The yellow.
     * @var float
     */
    private float $yellow;

    /**
     * Create a new CIELab color.
     *
     * @param float $cyan The cyan
     * @param float $magenta The magenta
     * @param float $yellow The yellow
     */
    public function __construct(float $cyan, float $magenta, float $yellow)
    {
        $this->toSelf = 'toCMY';
        $this->cyan = $cyan;
        $this->magenta = $magenta;
        $this->yellow = $yellow;
    }

    public static function create(float $cyan, float $magenta, float $yellow): self
    {
        return new self($cyan, $magenta, $yellow);
    }

    /**
     * Get the amount of Cyan.
     *
     * @return float The amount of cyan
     */
    public function getCyan(): float
    {
        return $this->cyan;
    }

    /**
     * Get the amount of Magenta.
     *
     * @return float The amount of magenta
     */
    public function getMagenta(): float
    {
        return $this->magenta;
    }

    /**
     * Get the amount of Yellow.
     *
     * @return float The amount of yellow
     */
    public function getYellow(): float
    {
        return $this->yellow;
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
        $red = (1 - $this->cyan) * 255;
        $green = (1 - $this->magenta) * 255;
        $blue = (1 - $this->yellow) * 255;

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
        return $this->toRGB()->toHSV();
    }

    /**
     * Convert the color to CMY format.
     *
     * @return CMY the color in CMY format
     */
    public function toCMY(): static
    {
        return $this;
    }

    /**
     * Convert the color to CMYK format.
     *
     * @return CMYK the color in CMYK format
     */
    public function toCMYK(): CMYK
    {
        $var_K = 1;
        $cyan = $this->cyan;
        $magenta = $this->magenta;
        $yellow = $this->yellow;
        if ($cyan < $var_K) {
            $var_K = $cyan;
        }
        if ($magenta < $var_K) {
            $var_K = $magenta;
        }
        if ($yellow < $var_K) {
            $var_K = $yellow;
        }
        if ($var_K == 1) {
            $cyan = 0;
            $magenta = 0;
            $yellow = 0;
        } else {
            $cyan = ($cyan - $var_K) / (1 - $var_K);
            $magenta = ($magenta - $var_K) / (1 - $var_K);
            $yellow = ($yellow - $var_K) / (1 - $var_K);
        }

        $key = $var_K;

        return new CMYK($cyan, $magenta, $yellow, $key);
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
     * @return string The color in format: $cyan,$magenta,$yellow
     */
    public function __toString(): string
    {
        return sprintf('%01.4f, %01.4f, %01.4f', $this->cyan, $this->magenta, $this->yellow);
    }
}
