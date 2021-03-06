<?php

namespace Odan\Test;

use Odan\Encoding\Base36;
use PHPUnit\Framework\TestCase;

/**
 * Base36Test
 *
 * @coversDefaultClass \Odan\Encoding\Base36
 */
class Base36Test extends TestCase
{

    /**
     * Test.
     *
     * @covers ::encode
     */
    public function testEncode()
    {
        $base36 = new Base36();
        $enc = $base36->encode(null);
        $this->assertEquals('', $enc);

        $enc = $base36->encode('');
        $this->assertEquals('', $enc);

        $enc = $base36->encode(0);
        $this->assertEquals('', $enc);

        $enc = $base36->encode('abc 1234');
        $this->assertEquals('MFRGGIBRGIZTI===', $enc);

        $enc = $base36->encode('abc 1234', false);
        $this->assertEquals('MFRGGIBRGIZTI', $enc);

        $enc = $base36->encode("\0€ÿ", false);
        $this->assertEquals('ADRIFLGDX4', $enc);
    }

    /**
     * Test.
     *
     * @covers ::decode
     */
    public function testDecode()
    {
        $base36 = new Base36();
        $dec = $base36->decode(null);
        $this->assertFalse($dec);

        $dec = $base36->decode('MFRGGIBRGIZTI====');
        $this->assertEquals('abc 1234', $dec);

        $dec = $base36->decode('MFRGGIBRGIZTI');
        $this->assertEquals('abc 1234', $dec);

        $dec = $base36->decode('ADRIFLGDX4');
        $this->assertEquals("\0€ÿ", $dec);
    }
}
