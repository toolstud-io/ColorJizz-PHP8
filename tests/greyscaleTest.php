<?php

use MischiefCollective\ColorJizz\Formats\Hex;
use PHPUnit\Framework\TestCase;

class greyscaleTest extends TestCase
{
    /**
     * @return void
     * @covers \MischiefCollective\ColorJizz\Formats\Hex
     */
    public function testGreyscale()
    {
        $this->assertEquals(0x000000, Hex::create(0x000000)->greyscale()->hex);
        $this->assertEquals(0x4D4D4D, Hex::create(0xFF0000)->greyscale()->hex);
        $this->assertEquals(0x969696, Hex::create(0x00FF00)->greyscale()->hex);
        $this->assertEquals(0x1C1C1C, Hex::create(0x0000FF)->greyscale()->hex);
    }
}
