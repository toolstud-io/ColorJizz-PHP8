[![Latest Version on Packagist](https://img.shields.io/packagist/v/toolstud-io/colorjizz-php8.svg?style=flat-square)](https://packagist.org/packages/toolstud-io/ColorJizz-PHP8)
[![composer test](https://github.com/toolstud-io/ColorJizz-PHP8/actions/workflows/php.yml/badge.svg)](https://github.com/toolstud-io/ColorJizz-PHP8/actions/workflows/php.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/toolstud-io/ColorJizz-PHP8.svg?style=flat-square)](https://packagist.org/packages/toolstud-io/ColorJizz-PHP8)

# ColorJizz, but for PHP8.0+

![](assets/unsplash.color.jpg)

### Installation

```bash
composer require toolstud-io/colorjizz-php8
```

### Converting between formats

ColorJizz can convert to and from any of the supported color formats:

```php
<?php
use MischiefCollective\ColorJizz\Formats\Hex;

$red_hex = new Hex(0xFF0000);
$red_cmyk = $hex->toCMYK();

echo get_class($red_cmyk); // MischiefCollective\ColorJizz\Formats\CMYK
echo $red_cmyk; // 0,1,1,0
?>
```

Any color manipulation or conversion will return a new instance of a color class, therefore your original color objects remains intact.

Color manipulation can be chained together:

```php
<?php
use MischiefCollective\ColorJizz\Formats\Hex;

echo Hex::fromString('red')->hue(-20)->greyscale(); // 555555
?>
```

Any color manipulation will always return the color in the same format unless you're specifically converting the format. For example:

```php
<?php
use MischiefCollective\ColorJizz\Formats\RGB;

$red = new RGB(255, 0, 0);
echo get_class($red->hue(-20)->saturation(2)); // MischiefCollective\ColorJizz\Formats\RGB
?>
```

###Supported formats:

```php
<?php
new RGB(r, g, b);
new CMY(c, m, y);
new CMYK(c, m, y, k);
new Hex(0x000000);
new HSV(h, s, v);
new CIELab(l, a, b);
new CIELCh(l, c, h);
new XYZ(x, y, z);
new Yxy(Y, x, y);
```

###Conversion functions:

```php
<?php
->toRGB();
->toCMY();
->toCMYK();
->toHex();
->toHSV();
->toCIELab();
->toCIELCh();
->toXYZ();
->toYxy();
```


