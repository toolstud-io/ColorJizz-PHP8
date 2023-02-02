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
 * CMYK represents the CMYK color format.
 *
 *
 * @author Mikee Franklin <mikeefranklin@gmail.com>
 */
class CMYK extends ColorJizz
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
     * The key (black).
     * @var float
     */
    private float $key;

    /**
     * Create a new CMYK color.
     *
     * @param float $cyan The cyan
     * @param float $magenta The magenta
     * @param float $yellow The yellow
     * @param float $key The key (black)
     */
    public function __construct(float $cyan, float $magenta, float $yellow, float $key)
    {
        $this->toSelf = 'toCMYK';
        $this->cyan = $cyan;
        $this->magenta = $magenta;
        $this->yellow = $yellow;
        $this->key = $key;
    }

    public static function create(float $cyan, float $magenta, float $yellow, float $key): self
    {
        return new self($cyan, $magenta, $yellow, $key);
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
     * Get the key (black).
     *
     * @return float The amount of black
     */
    public function getKey(): float
    {
        return $this->key;
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
        return $this->toCMY()->toRGB();
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
    public function toCMY(): CMY
    {
        $cyan = ($this->cyan * (1 - $this->key) + $this->key);
        $magenta = ($this->magenta * (1 - $this->key) + $this->key);
        $yellow = ($this->yellow * (1 - $this->key) + $this->key);

        return new CMY($cyan, $magenta, $yellow);
    }

    /**
     * Convert the color to CMYK format.
     *
     * @return CMYK the color in CMYK format
     */
    public function toCMYK(): static
    {
        return $this;
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
     * @return string The color in format: $cyan,$magenta,$yellow,$key
     */
    public function __toString(): string
    {
        return sprintf('%01.4f, %01.4f, %01.4f, %01.4f', $this->cyan, $this->magenta, $this->yellow, $this->key);
    }
}
