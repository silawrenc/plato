<?php

namespace plato;

use plato\test\ValidatorTest;

class GenericValidatorsTest extends ValidatorTest
{
    public function testData()
    {
        return [
            [required(), '', false],
            [required(), 'foo', true],
            [forbidden(), '', false],
            [forbidden(), null, true],
            [equals(3), 5, false],
            [equals(5), 5, true],
            [whitelist([1,3]), 5, false],
            [whitelist([1,3]), 3, true],
            [blacklist([1,3]), 3, false],
            [blacklist([1,3]), 5, true]
        ];
    }
}
