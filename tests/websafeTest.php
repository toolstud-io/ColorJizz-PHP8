<?php

use MischiefCollective\ColorJizz\Formats\Hex;
use PHPUnit\Framework\TestCase;

class websafeTest extends TestCase
{
    /**
     * @throws \MischiefCollective\ColorJizz\Exceptions\InvalidArgumentException
     * @covers \MischiefCollective\ColorJizz\Hex
     */
    public function testWebsafe()
    {
        $this->assertEquals('CC0000', Hex::fromString('CD0000')->websafe()->__toString());
        $this->assertEquals('CC0000', Hex::fromString('CD0100')->websafe()->__toString());
        $this->assertEquals('CC00FF', Hex::fromString('CD00FE')->websafe()->__toString());
        $this->assertEquals('000000', Hex::fromString('010000')->websafe()->__toString());
    }
}
