<?php

namespace plato;

use plato\test\ValidatorTest;

class MathValidatorsTest extends ValidatorTest
{
    public function testData()
    {
        return [
            [lessthan(5), 7, false],
            [lessthan(5), 3, true],
            [lessthanequal(5), 6, false],
            [lessthanequal(5), 5, true],
            [morethan(5), 3, false],
            [morethan(5), 7, true],
            [morethanequal(5), 4, false],
            [morethanequal(5), 5, true],
            [range(1,3), 3.7, false],
            [range(1.5, 19), 5.3, true],
            [xrange(1,3), 1, false],
            [xrange(1.5, 19), 5.3, true]        ];
    }
}
