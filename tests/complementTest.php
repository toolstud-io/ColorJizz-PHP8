<?php

use MischiefCollective\ColorJizz\Formats\Hex;
use PHPUnit\Framework\TestCase;

class complementTest extends TestCase
{
    /**
     * @throws \MischiefCollective\ColorJizz\Exceptions\InvalidArgumentException
     * @covers \MischiefCollective\ColorJizz\Formats\Hex
     */
    public function testWebsafe()
    {
        $this->assertEquals('FFFFFF', Hex::fromString('FFFFFF')->complement()->__toString());
        $this->assertEquals('00A1F3', Hex::fromString('FF0000')->complement()->__toString());
    }
}
