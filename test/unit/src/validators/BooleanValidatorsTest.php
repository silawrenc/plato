<?php

namespace plato;

use PHPUnit_Framework_TestCase as TestCase;

class BooleanValidatorsTest extends TestCase
{
    public function testData()
    {
        return [
            [istrue(), 1, false],
            [istrue(), true, true],
            [istrueish(), 0, false],
            [istrueish(), 'foo', false],
            [isfalse(), 0, false],
            [isfalse(), false, true],
            [isfalsy(), 'bananas', false],
            [isfalsy(), '', true],
        ];
    }
}
