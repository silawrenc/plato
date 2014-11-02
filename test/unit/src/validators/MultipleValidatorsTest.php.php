<?php

namespace plato;

class MultipleValidatorsTest extends ValidatorTest
{
    /**
    * @dataProvider testData
    */
    public function testValidators($validator, $candidate, $result)
    {
        $this->assertEquals($result, call_user_func_array($validator, $candidate));
    }

    public function testData()
    {
        return [
            [identical(), ['1',1], false],
            [identical(), ['a', 'a'], true],
            [either(), [null, ''], false],
            [either(), [null, 6], true],
            [exclusive(), [3, 6], false],
            [exclusive(), [null, 6], true],
            [comparisonlessthan(), [4,1], false],
            [comparisonlessthan(), [1,4], true],
            [comparisonlessthanequal(), [4,1], false],
            [comparisonlessthanequal(), [4,4], true],
            [comparisonmorethan(), [1,4], false],
            [comparisonmorethan(), [4,1], true],
            [comparisonmorethanequal(), [1,4], false],
            [comparisonmorethanequal(), [4,4], true],
        ];
    }
}
