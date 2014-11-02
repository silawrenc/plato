<?php

namespace plato;

use PHPUnit_Framework_TestCase as TestCase;

class MessageTest extends TestCase
{
    public function testMessageFails()
    {
        $message = message('oh dear', required());
        $foo = null;
        $this->assertEquals('oh dear', $message($foo));
    }

    public function testMessagePasses()
    {
        $message = message('oh dear', required());

        $this->assertEquals(null, $message('foo'));
    }
}
