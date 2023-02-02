<?php

/*
 * This file is part of the ColorJizz package.
 *
 * (c) Mikee Franklin <mikee@mischiefcollective.com>
 *
 */

namespace MischiefCollective\ColorJizz;

use MischiefCollective\ColorJizz\Exceptions\InvalidArgumentException;
use MischiefCollective\ColorJizz\Formats\CIELab;
use MischiefCollective\ColorJizz\Formats\CIELCh;
use MischiefCollective\ColorJizz\Formats\CMY;
use MischiefCollective\ColorJizz\Formats\CMYK;
use MischiefCollective\ColorJizz\Formats\Hex;
use MischiefCollective\ColorJizz\Formats\HSL;
use MischiefCollective\ColorJizz\Formats\HSV;
use MischiefCollective\ColorJizz\Formats\RGB;
use MischiefCollective\ColorJizz\Formats\XYZ;
use MischiefCollective\ColorJizz\Formats\Yxy;

/**
 * ColorJizz is the base class that all color objects extend.
 *
 *
 * @author Mikee Franklin <mikee@mischiefcollective.com>
 */
abstract class ColorJizz
{
    protected string $toSelf;

    /**
     * Convert the color to Hex format.
     *
     * @return Hex the color in Hex format
     */
    abstract public function toHex(): Hex;

    /**
     * Convert the color to RGB format.
     *
     * @return RGB the color in RGB format
     */
    abstract public function toRGB(): RGB;

    /**
     * Convert the color to XYZ format.
     *
     * @return XYZ the color in XYZ format
     */
    abstract public function toXYZ(): Formats\XYZ;

    /**
     * Convert the color to Yxy format.
     *
     * @return Yxy the color in Yxy format
     */
    abstract public function toYxy(): Yxy;

    /**
     * Convert the color to CIELab format.
     *
     * @return CIELab the color in CIELab format
     */
    abstract public function toCIELab(): CIELab;

    /**
     * Convert the color to CIELCh format.
     *
     * @return CIELCh the color in CIELCh format
     */
    abstract public function toCIELCh(): CIELCh;

    /**
     * Convert the color to CMY format.
     *
     * @return CMY the color in CMY format
     */
    abstract public function toCMY(): CMY;

    /**
     * Convert the color to CMYK format.
     *
     * @return CMYK the color in CMYK format
     */
    abstract public function toCMYK(): CMYK;

    /**
     * Convert the color to HSV format.
     *
     * @return HSV the color in HSV format
     */
    abstract public function toHSV(): HSV;

    /**
     * Convert the color to HSL format.
     *
     * @return HSL the color in HSL format
     */
    abstract public function toHSL(): HSL;

    /**
     * Find the distance to the destination color.
     *
     * @param ColorJizz $destinationColor The destination color
     *
     * @return float distance to destination color
     */
    public function distance(self $destinationColor): float
    {
        $a = $this->toCIELab();
        $b = $destinationColor->toCIELab();

        $lightness_pow = pow(($a->lightness - $b->lightness), 2);
        $a_dimension_pow = pow(($a->a_dimension - $b->a_dimension), 2);
        $b_dimension_pow = pow(($a->b_dimension - $b->b_dimension), 2);

        return sqrt($lightness_pow + $a_dimension_pow + $b_dimension_pow);
    }

    /**
     * Find the closest websafe color.
     *
     * @return ColorJizz The closest color
     * @throws InvalidArgumentException
     */
    public function websafe(): ColorJizz
    {
        $palette = [];
        for ($red = 0; $red <= 255; $red += 51) {
            for ($green = 0; $green <= 255; $green += 51) {
                for ($blue = 0; $blue <= 255; $blue += 51) {
                    $palette[] = new RGB($red, $green, $blue);
                }
            }
        }

        return $this->match($palette);
    }

    /**
     * Match the current color to the closest from the array $palette.
     *
     * @param array $palette An array of ColorJizz objects to match against
     *
     * @return ColorJizz The closest color
     */
    public function match(array $palette): ColorJizz
    {
        $distance = 100000000000;
        $closest = null;
        for ($i = 0; $i < count($palette); $i++) {
            $cdistance = $this->distance($palette[$i]);
            if ($distance == 100000000000 || $cdistance < $distance) {
                $distance = $cdistance;
                $closest = $palette[$i];
            }
        }

        return call_user_func([$closest, $this->toSelf]);
    }

    public function equal($parts, $includeSelf = false): array
    {
        $parts = max($parts, 2);
        $current = $this->toCIELCh();
        $distance = 360 / $parts;
        $palette = [];
        if ($includeSelf) {
            $palette[] = $this;
        }
        for ($i = 1; $i < $parts; $i++) {
            $t = new CIELCh($current->lightness, $current->chroma, $current->hue + ($distance * $i));
            $palette[] = call_user_func([$t, $this->toSelf]);
        }

        return $palette;
    }

    public function split($includeSelf = false): array
    {
        $rtn = [];
        $t = $this->hue(-150);
        $rtn[] = call_user_func([$t, $this->toSelf]);
        if ($includeSelf) {
            $rtn[] = $this;
        }
        $t = $this->hue(150);
        $rtn[] = call_user_func([$t, $this->toSelf]);

        return $rtn;
    }

    /**
     * Return the opposite, complimentary color.
     *
     * @return ColorJizz The greyscale color
     */
    public function complement(): ColorJizz
    {
        return $this->hue(180);
    }

    public function isDark(): bool
    {
        $sHexColor = $this->toHex();
        $r = (hexdec(substr($sHexColor, 0, 2)) / 255);
        $g = (hexdec(substr($sHexColor, 2, 2)) / 255);
        $b = (hexdec(substr($sHexColor, 4, 2)) / 255);
        $lightness = round((((max($r, $g, $b) + min($r, $g, $b)) / 2) * 100));
        return $lightness < 50;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getMatchingTextColor(): Hex
    {
        if ($this->isDark() === false) {
            return new Hex(0x000000);
        } else {
            return new Hex(0xFFFFFF);
        }
    }

    /**
     * Find complimentary colors.
     *
     * @param bool $includeSelf Include the current color in the return array
     *
     * @return array Array of complimentary colors
     */
    public function sweetspot(bool $includeSelf = false): array
    {
        $colors = [$this->toHSV()];
        $colors[1] = new HSV($colors[0]->hue, round($colors[0]->saturation * 0.3), min(round($colors[0]->value * 1.3), 100));
        $colors[3] = new HSV(($colors[0]->hue + 300) % 360, $colors[0]->saturation, $colors[0]->value);
        $colors[2] = new HSV($colors[1]->hue, min(round($colors[1]->saturation * 1.2), 100), min(round($colors[1]->value * 0.5), 100));
        $colors[4] = new HSV($colors[2]->hue, 0, ($colors[2]->value + 50) % 100);
        $colors[5] = new HSV($colors[4]->hue, $colors[4]->saturation, ($colors[4]->value + 50) % 100);
        if (!$includeSelf) {
            array_shift($colors);
        }
        for ($i = 0; $i < count($colors); $i++) {
            $colors[$i] = call_user_func([$colors[$i], $this->toSelf]);
        }

        return $colors;
    }

    public function analogous(bool $includeSelf = false): array
    {
        $rtn = [];
        $t = $this->hue(-30);
        $rtn[] = call_user_func([$t, $this->toSelf]);

        if ($includeSelf) {
            $rtn[] = $this;
        }

        $t = $this->hue(30);
        $rtn[] = call_user_func([$t, $this->toSelf]);

        return $rtn;
    }

    public function rectangle(float $sideLength, bool $includeSelf = false): array
    {
        $side1 = $sideLength;
        $side2 = (360 - ($sideLength * 2)) / 2;
        $current = $this->toCIELCh();
        $rtn = [];

        $t = new CIELCh($current->lightness, $current->chroma, $current->hue + $side1);
        $rtn[] = call_user_func([$t, $this->toSelf]);

        $t = new CIELCh($current->lightness, $current->chroma, $current->hue + $side1 + $side2);
        $rtn[] = call_user_func([$t, $this->toSelf]);

        $t = new CIELCh($current->lightness, $current->chroma, $current->hue + $side1 + $side2 + $side1);
        $rtn[] = call_user_func([$t, $this->toSelf]);

        if ($includeSelf) {
            array_unshift($rtn, $this);
        }

        return $rtn;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function range(self $destinationColor, int $steps, bool $includeSelf = false): array
    {
        $a = $this->toRGB();
        $b = $destinationColor->toRGB();
        $colors = [];
        $steps--;
        for ($n = 1; $n < $steps; $n++) {
            $nr = floor($a->red + ($n * ($b->red - $a->red) / $steps));
            $ng = floor($a->green + ($n * ($b->green - $a->green) / $steps));
            $nb = floor($a->blue + ($n * ($b->blue - $a->blue) / $steps));
            $t = new RGB($nr, $ng, $nb);
            $colors[] = call_user_func([$t, $this->toSelf]);
        }
        if ($includeSelf) {
            array_unshift($colors, $this);
            $colors[] = call_user_func([$destinationColor, $this->toSelf]);
        }

        return $colors;
    }

    /**
     * Return a greyscale version of the current color.
     *
     * @return ColorJizz The greyscale color
     * @throws InvalidArgumentException
     */
    public function greyscale(): ColorJizz
    {
        $a = $this->toRGB();
        $ds = $a->red * 0.3 + $a->green * 0.59 + $a->blue * 0.11;
        $t = new RGB($ds, $ds, $ds);

        return call_user_func([$t, $this->toSelf]);
    }

    /**
     * Modify the hue by $degreeModifier degrees.
     *
     * @param int $degreeModifier Degrees to modify by
     * @param bool $absolute If TRUE set absolute value
     *
     * @return ColorJizz The modified color
     */
    public function hue(int $degreeModifier, bool $absolute = false): ColorJizz
    {
        $a = $this->toCIELCh();
        $a->hue = $absolute ? $degreeModifier : $a->hue + $degreeModifier;
        $a->hue = fmod($a->hue, 360);

        return call_user_func([$a, $this->toSelf]);
    }

    /**
     * Modify the saturation by $satModifier.
     *
     * @param int $satModifier Value to modify by
     * @param bool $absolute If TRUE set absolute value
     *
     * @return ColorJizz The modified color
     */
    public function saturation(int $satModifier, bool $absolute = false): ColorJizz
    {
        $a = $this->toHSV();
        $a->saturation = $absolute ? $satModifier : $a->saturation + $satModifier;

        return call_user_func([$a, $this->toSelf]);
    }

    /**
     * Modify the brightness by $brightnessModifier.
     *
     * @param int $brightnessModifier Value to modify by
     * @param bool $absolute If TRUE set absolute value
     *
     * @return ColorJizz The modified color
     */
    public function brightness(int $brightnessModifier, bool $absolute = false): ColorJizz
    {
        $a = $this->toCIELab();
        $a->lightness = $absolute ? $brightnessModifier : $a->lightness + $brightnessModifier;

        return call_user_func([$a, $this->toSelf]);
    }
}
