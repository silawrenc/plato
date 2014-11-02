<?php

namespace plato;

use PHPUnit_Framework_TestCase as TestCase;

class ValidateTest extends TestCase
{
    public function setUp()
    {
        $this->schema = [];
    }

    public function testNoRules()
    {
        $this->assertResult([], []);
    }

    public function testSingleRuleFails()
    {
        $this->schema[] = rule('name.required', 'name', required());
        $this->assertResult(['name.required'], []);
    }

    public function testSingleRulePasses()
    {
        $this->schema[] = rule('name.required', 'name', required());
        $this->assertResult([], ['name' => 'Freddy']);
    }

    public function testRuleMultipleCallbacksFails()
    {
        $this->schema[] = rule('name.valid', 'name', [required(), minlength(8)]);
        $this->assertResult(['name.valid'], ['name' => 'Freddy']);
    }

    public function testRuleMultipleCallbacksPasses()
    {
        $this->schema[] = rule('name.valid', 'name', [required(), minlength(4)]);
        $this->assertResult([], ['name' => 'Freddy']);
    }

    public function testRuleMultipleKeysFails()
    {
        $this->schema[] = rule('names.matching', ['name','repeat'], identical());
        $this->assertResult(['names.matching'], ['name' => 'Freddy']);
    }

    public function testRuleMultipleKeysPasses()
    {
        $this->schema[] = rule('name.matching', ['name','repeat'], identical());
        $this->assertResult([], ['name' => 'Freddy', 'repeat' => 'Freddy']);
    }

    public function testRuleMultipleKeysMultipleCallbacksFails()
    {
        $this->schema[] = rule('names.matching.length', ['name','repeat'], identical(), all(minlength(4)));
        $this->assertResult(['names.matching.length'], ['name' => 'Freddy']);
    }

    public function testRuleMultipleKeysMultipleCallbacksPasses()
    {
        $this->schema[] = rule('names.matching.length', ['name','repeat'], identical(), all(minlength(4)));
        $this->assertResult([], ['name' => 'Freddy', 'repeat' => 'Freddy']);
    }

    public function testMultipleRulesFails()
    {
        $this->schema[] = rule('name.required', 'name', required());
        $this->schema[] = rule('profession.required', 'profession', required());

        $this->assertResult(['name.required', 'profession.required'], ['absent' => 'data']);
    }

    public function testMultipleRulesPasses()
    {
        $this->schema[] = rule('name.required', 'name', required());
        $this->schema[] = rule('profession.required', 'profession', required());

        $this->assertResult([], ['name' => 'Bill', 'profession' => 'Potter']);
    }


    protected function assertResult($result, $data)
    {
        $this->assertEquals($result, validate($data, $this->schema));
    }
}
