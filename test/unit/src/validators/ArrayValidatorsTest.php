<?php

namespace plato;

class ArrayValidatorsTest extends ValidatorTest
{
    public function testData()
    {
        return [
            [containskeys(['foo']), ['bar' => 3], false],
            [containskeys(['bar']), ['bar' => 3], true],
            [containsvalues([1,3]), ['bar' => 3], false],
            [containsvalues([3]), ['bar' => 3], true]
        ];
    }
}
