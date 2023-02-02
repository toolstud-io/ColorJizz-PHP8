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
 * Hex represents the Hex color format.
 *
 *
 * @author Mikee Franklin <mikeefranklin@gmail.com>
 */
class Hex extends ColorJizz
{
    private static array $color_names = [
        'aliceblue' => 0xF0F8FF,
        'alizarin' => 0xE32636,
        'amaranth' => 0xE52B50,
        'amber' => 0xFFBF00,
        'amethyst' => 0x9966CC,
        'antiquewhite' => 0xFAEBD7,
        'apricot' => 0xFBCEB1,
        'aqua' => 0x00FFFF,
        'aquamarine' => 0x7FFFD4,
        'arsenic' => 0x3B444B,
        'asparagus' => 0x7BA05B,
        'auburn' => 0x6D351A,
        'azure' => 0xF0FFFF,
        'beige' => 0xF5F5DC,
        'bisque' => 0xFFE4C4,
        'bistre' => 0x3D2B1F,
        'black' => 0x000000,
        'blanchedalmond' => 0xFFEBCD,
        'blue' => 0x0000FF,
        'bluegreen' => 0x00DDDD,
        'blueviolet' => 0x8A2BE2,
        'bole' => 0x79443B,
        'brass' => 0xB5A642,
        'bronze' => 0xCD7F32,
        'brown' => 0xA52A2A,
        'buff' => 0xF0DC82,
        'burgundy' => 0x800020,
        'burlywood' => 0xDEB887,
        'byzantium' => 0x702963,
        'cadetblue' => 0x5F9EA0,
        'cardinal' => 0xC41E3A,
        'carmine' => 0x960018,
        'carnelian' => 0xB31B1B,
        'celadon' => 0xACE1AF,
        'cerise' => 0xDE3163,
        'cerulean' => 0x007BA7,
        'champaigne' => 0xF7E7CE,
        'charcoal' => 0x464646,
        'chartreuse' => 0x7FFF00,
        'chestnut' => 0xCD5C5C,
        'chocolate' => 0x7B3F00,
        'cinnabar' => 0xE34234,
        'cinnamon' => 0xD2691E,
        'cobalt' => 0x0047AB,
        'copper' => 0xB87333,
        'coral' => 0xFF7F50,
        'cordovan' => 0x893F45,
        'corn' => 0xFBEC5D,
        'cornflowerblue' => 0x6495ED,
        'cornsilk' => 0xFFF8DC,
        'cream' => 0xFFFDD0,
        'crimson' => 0xDC143C,
        'cyan' => 0x00FFFF,
        'darkblue' => 0x00008B,
        'darkcyan' => 0x008B8B,
        'darkgoldenrod' => 0xB8860B,
        'darkgray' => 0xA9A9A9,
        'darkgreen' => 0x006400,
        'darkkhaki' => 0xBDB76B,
        'darkmagenta' => 0x8B008B,
        'darkolivegreen' => 0x556B2F,
        'darkorange' => 0xFF8C00,
        'darkorchid' => 0x9932CC,
        'darkred' => 0x8B0000,
        'darksalmon' => 0xE9967A,
        'darkseagreen' => 0x8FBC8F,
        'darkslateblue' => 0x483D8B,
        'darkslategray' => 0x2F4F4F,
        'darkturquoise' => 0x00CED1,
        'darkviolet' => 0x9400D3,
        'deeppink' => 0xFF1493,
        'deepskyblue' => 0x00BFFF,
        'denim' => 0x1560BD,
        'dimgray' => 0x696969,
        'dodgerblue' => 0x1E90FF,
        'ecru' => 0xC2B280,
        'eggplant' => 0x614051,
        'emerald' => 0x50C878,
        'fallow' => 0xC19A6B,
        'feldgrau' => 0x4D5D53,
        'firebrick' => 0xB22222,
        'flax' => 0xEEDC82,
        'floralwhite' => 0xFFFAF0,
        'forestgreen' => 0x228B22,
        'fuchsia' => 0xFF00FF,
        'gainsboro' => 0xDCDCDC,
        'gamboge' => 0xE49B0F,
        'ghostwhite' => 0xF8F8FF,
        'gold' => 0xFFD700,
        'goldenrod' => 0xDAA520,
        'gray' => 0x808080,
        'green' => 0x008000,
        'greenyellow' => 0xADFF2F,
        'harlequin' => 0x3FFF00,
        'heliotrope' => 0xDF73FF,
        'honeydew' => 0xF0FFF0,
        'hotpink' => 0xFF69B4,
        'indianred' => 0xCD5C5C,
        'indigo' => 0x4B0082,
        'ivory' => 0xFFFFF0,
        'jade' => 0x00A86B,
        'khaki' => 0xF0E68C,
        'lava' => 0xCF1020,
        'lavender' => 0xE6E6FA,
        'lavenderblush' => 0xFFF0F5,
        'lawngreen' => 0x7CFC00,
        'lemon' => 0xFDE910,
        'lemonchiffon' => 0xFFFACD,
        'lightblue' => 0xADD8E6,
        'lightcoral' => 0xF08080,
        'lightcyan' => 0xE0FFFF,
        'lightgoldenrodyellow' => 0xFAFAD2,
        'lightgreen' => 0x90EE90,
        'lightgrey' => 0xD3D3D3,
        'lightpink' => 0xFFB6C1,
        'lightsalmon' => 0xFFA07A,
        'lightseagreen' => 0x20B2AA,
        'lightskyblue' => 0x87CEFA,
        'lightslategray' => 0x778899,
        'lightsteelblue' => 0xB0C4DE,
        'lightyellow' => 0xFFFFE0,
        'lilac' => 0xC8A2C8,
        'lime' => 0x00FF00,
        'limegreen' => 0x32CD32,
        'linen' => 0xFAF0E6,
        'liver' => 0x534B4F,
        'magenta' => 0xFF00FF,
        'magnolia' => 0xF8F4FF,
        'mahogany' => 0xC04000,
        'maize' => 0xFBEC5D,
        'malachite' => 0x0BDA51,
        'maroon' => 0x800000,
        'mauve' => 0xE0B0FF,
        'mediumaquamarine' => 0x66CDAA,
        'mediumblue' => 0x0000CD,
        'mediumorchid' => 0xBA55D3,
        'mediumpurple' => 0x9370D8,
        'mediumseagreen' => 0x3CB371,
        'mediumslateblue' => 0x7B68EE,
        'mediumspringgreen' => 0x00FA9A,
        'mediumturquoise' => 0x48D1CC,
        'mediumvioletred' => 0xC71585,
        'midnightblue' => 0x191970,
        'mintcream' => 0xF5FFFA,
        'mistyrose' => 0xFFE4E1,
        'moccasin' => 0xFFE4B5,
        'mustard' => 0xFFDB58,
        'myrtle' => 0x21421E,
        'navajowhite' => 0xFFDEAD,
        'navy' => 0x000080,
        'ochre' => 0xCC7722,
        'oldlace' => 0xFDF5E6,
        'olive' => 0x808000,
        'olivedrab' => 0x6B8E23,
        'olivine' => 0x9AB973,
        'orange' => 0xFFA500,
        'orangered' => 0xFF4500,
        'orchid' => 0xDA70D6,
        'palegoldenrod' => 0xEEE8AA,
        'palegreen' => 0x98FB98,
        'paleturquoise' => 0xAFEEEE,
        'palevioletred' => 0xD87093,
        'papayawhip' => 0xFFEFD5,
        'peach' => 0xFFE5B4,
        'peach-orange' => 0xFFCC99,
        'peach-yellow' => 0xFADFAD,
        'peachpuff' => 0xFFDAB9,
        'pear' => 0xD1E231,
        'periwinkle' => 0xCCCCFF,
        'persimmon' => 0xEC5800,
        'peru' => 0xCD853F,
        'pink' => 0xFFC0CB,
        'pink-orange' => 0xFF9966,
        'platinum' => 0xE5E4E2,
        'plum' => 0xDDA0DD,
        'powderblue' => 0xB0E0E6,
        'puce' => 0xCC8899,
        'pumpkin' => 0xFF7518,
        'purple' => 0x800080,
        'raspberry' => 0xE30B5C,
        'razzmatazz' => 0xE3256B,
        'red' => 0xFF0000,
        'red-violet' => 0xC71585,
        'rose' => 0xFF007F,
        'rosybrown' => 0xBC8F8F,
        'royalblue' => 0x4169E1,
        'ruby' => 0xE0115F,
        'russet' => 0x80461B,
        'rust' => 0xB7410E,
        'saddlebrown' => 0x8B4513,
        'saffron' => 0xF4C430,
        'salmon' => 0xFA8072,
        'sandybrown' => 0xF4A460,
        'sangria' => 0x92000A,
        'sapphire' => 0x082567,
        'scarlet' => 0xFF2400,
        'seagreen' => 0x2E8B57,
        'seashell' => 0xFFF5EE,
        'sepia' => 0x704214,
        'sienna' => 0xA0522D,
        'silver' => 0xC0C0C0,
        'skyblue' => 0x87CEEB,
        'slateblue' => 0x6A5ACD,
        'slategray' => 0x708090,
        'snow' => 0xFFFAFA,
        'springgreen' => 0x00FF7F,
        'steelblue' => 0x4682B4,
        'tan' => 0xD2B48C,
        'tangerine' => 0xF28500,
        'taupe' => 0x483C32,
        'teal' => 0x008080,
        'thistle' => 0xD8BFD8,
        'tomato' => 0xFF6347,
        'turquoise' => 0x30D5C8,
        'ultramarine' => 0x120A8F,
        'vermilion' => 0xE34234,
        'violet' => 0xEE82EE,
        'viridian' => 0x40826D,
        'wheat' => 0xF5DEB3,
        'white' => 0xFFFFFF,
        'whitesmoke' => 0xF5F5F5,
        'wisteria' => 0xC9A0DC,
        'xanadu' => 0x738678,
        'yellow' => 0xFFFF00,
        'yellowgreen' => 0x9ACD32,
    ];

    /**
     * The value of the color.
     * @var int
     */
    public int $hex;

    /**
     * Create a new Hex.
     *
     * @param int $hex the hexidecimal value (i.e. 0x000000)
     * @throws InvalidArgumentException
     */
    public function __construct(int $hex)
    {
        if ($hex > 0xFFFFFF || $hex < 0) {
            throw new InvalidArgumentException(sprintf('Parameter hex out of range (%s)', $hex));
        }

        $this->hex = $hex;
        $this->toSelf = 'toHex';
    }

    /**
     * Create a new Hex.
     *
     * @param int $hex the hexidecimal value (i.e. 0x000000)
     *
     * @return Hex the color in Hex format
     * @throws InvalidArgumentException
     */
    public static function create(int $hex): self
    {
        return new self($hex);
    }

    /**
     * Convert the color to Hex format.
     *
     * @return Hex the color in Hex format
     */
    public function toHex(): static
    {
        return $this;
    }

    /**
     * Convert the color to RGB format.
     *
     * @return RGB the color in RGB format
     * @throws InvalidArgumentException
     */
    public function toRGB(): RGB
    {
        $red = (($this->hex & 0xFF0000) >> 16);
        $green = (($this->hex & 0x00FF00) >> 8);
        $blue = (($this->hex & 0x0000FF));

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
        return $this->toRGB()->toYxy();
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
        return $this->toXYZ()->toCIELab();
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
     * Returns the color name if available otherwise returns false.
     *
     * @return mixed    Color name as string or false if the color has no name
     */
    public function hasColorName(): string
    {
        $aColorNames = array_flip(self::$color_names);

        if (isset($aColorNames[$this->hex])) {
            return $aColorNames[$this->hex];
        }

        return '';
    }

    /**
     * A string representation of this color in the current format.
     *
     * @return string The color in format: RRGGBB
     * @throws InvalidArgumentException
     */
    public function __toString(): string
    {
        $rgb = $this->toRGB();
        $hex = str_pad(dechex($rgb->getRed()), 2, '0', STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb->getGreen()), 2, '0', STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb->getBlue()), 2, '0', STR_PAD_LEFT);

        return strtoupper($hex);
    }

    /**
     * Create a new Hex from a string.
     *
     * @param string $str Can be a color name or string hex value (i.e. "FFFFFF")
     *
     * @return Hex the color in Hex format
     * @throws InvalidArgumentException
     */
    public static function fromString(string $str): self
    {
        $str = strtolower($str);

        if (array_key_exists($str, self::$color_names)) {
            return new self(self::$color_names[$str]);
        }

        if (str_starts_with($str, '#')) {
            $str = substr($str, 1);
        }

        if (strlen($str) == 3) {
            $str = str_repeat($str[0], 2) . str_repeat($str[1], 2) . str_repeat($str[2], 2);
        }

        if (!preg_match('/[0-9A-F]{6}/i', $str)) {
            throw new InvalidArgumentException(sprintf('Parameter str is an invalid hex string (%s)', $str));
        }

        return new self(hexdec($str));
    }
}
