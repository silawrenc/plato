<?php

namespace plato;

use PHPUnit_Framework_TestCase as TestCase;

class RuleTest extends TestCase
{
    public function testRuleSingleKeySingleFunctionFails()
    {
        $rule = rule('name.required' , 'name', required());

        $data = ['foo' => 'bar'];

        $this->assertEquals('name.required', $rule($data));
    }

    public function testRuleSingleKeySingleFunctionPasses()
    {
        $rule = rule('name.required' , 'name', required());

        $data = ['name' => 'jimmy'];

        $this->assertEquals(null, $rule($data));
    }

    public function testRuleSingleKeyArrayCallableFails()
    {
        $rule = rule('name.required' , 'name', $this->getArrayCallable());

        $data = ['foo' => 'bar'];

        $this->assertEquals('name.required', $rule($data));
    }

    public function testRuleSingleKeyArrayCallablePasses()
    {
        $rule = rule('name.required' , 'name', $this->getArrayCallable());

        $data = ['name' => 'jimmy'];

        $this->assertEquals(null, $rule($data));
    }

    public function testRuleSingleKeyMultiFunctionsFails()
    {
        $rule = rule('name.required' , 'name', [required(), minlength(6), $this->getArrayCallable()]);

        $data = ['name' => 'bar'];

        $this->assertEquals('name.required', $rule($data));
    }

    public function testRuleSingleKeyMultiFunctionsPasses()
    {
        $rule = rule('name.required' , 'name', [required(), minlength(6), $this->getArrayCallable()]);

        $data = ['name' => 'Cuthbert'];

        $this->assertEquals(null, $rule($data));
    }

    public function testRuleMultiKeySingleFunctionFails()
    {
        $rule = rule('passwords.match' , ['password', 'repeat'], identical());

        $data = ['password' => 'foo'];

        $this->assertEquals('passwords.match', $rule($data));
    }

    public function testRuleMultiKeySingleFunctionPasses()
    {
        $rule = rule('passwords.match' , ['password', 'repeat'], identical());

        $data = ['password' => 'foo', 'repeat' => 'foo'];

        $this->assertEquals(null, $rule($data));
    }

    public function testRuleMultiKeyMultiFunctionsFails()
    {
        $rule = rule('count.match' , ['first', 'second'], [identical(), comparisonlessthan()]);

        $data = ['first' => 1, 'second' => 2];

        $this->assertEquals('count.match', $rule($data));
    }

    public function testRuleMultiKeyMultiFunctionsPasses()
    {
        $rule = rule('count.lessthanequal' , ['first', 'second'], [comparisonlessthan(), comparisonlessthanequal()]);

        $data = ['first' => 1, 'second' => 2];

        $this->assertEquals(null, $rule($data));
    }

    protected function getArrayCallable()
    {
        return ['plato\test\DummyObject', 'required'];
    }
}
