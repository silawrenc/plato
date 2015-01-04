<?php

namespace plato;

use plato\test\ValidatorTest;

class ConstructValidatorsTest extends ValidatorTest
{
    public function testData()
    {
        return [
            [oneof(range(7, 10), lessthan(5)), 20, false],
            [oneof(required(), lessthan(5)), 7, true],
            [oneofx(required(), lessthan(5)), 3, false],
            [oneofx(required(), lessthan(5)), 7, true],
            [oneofx(range(7,10), lessthan(5)), 20, false],
            [allof(required(), lessthan(5)), 7, false],
            [allof(required(), lessthan(5)), 3, true],
            [noneof(required(), lessthan(5)), 7, false],
            [noneof(equals(4), lessthan(5)), 6, true],
            [not(required()), 3, false],
            [not(required()), null, true],
            [schema([rule('name.required', 'name', required())]), ['absent' => 'data'], false],
            [schema([rule('name.required', 'name', required())]), ['name' => 'Bill'], true]
        ];
    }
}
