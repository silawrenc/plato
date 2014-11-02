<?php

namespace plato;

use PHPUnit_Framework_TestCase as TestCase;

abstract class ValidatorTest extends TestCase
{
    /**
     * @dataProvider testData
     */
    public function testValidators($validator, $candidate, $result)
    {
        $this->assertEquals($result, call_user_func($validator, $candidate));
    }

    abstract public function testData();
}
