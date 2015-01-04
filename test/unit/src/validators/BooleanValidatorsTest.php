<?php

namespace plato;

use plato\test\ValidatorTest;

class BooleanValidatorsTest extends ValidatorTest
{
    public function testData()
    {
        return [
            [istrue(), 1, false],
            [istrue(), true, true],
            [istrueish(), 0, false],
            [istrueish(), 'foo', true],
            [isfalse(), 0, false],
            [isfalse(), false, true],
            [isfalsy(), 'bananas', false],
            [isfalsy(), '', true],
        ];
    }
}
