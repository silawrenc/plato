<?php

namespace plato;

use PHPUnit_Framework_TestCase as TestCase;

class AssertTest extends TestCase
{
    public function testNoRules()
    {
        $this->assertNull(assert([], []));
    }

    public function testSingleRuleFails()
    {
        $this->setExpectedException('\plato\PlatoException');
        assert([], rule('name.required', 'name', required()));
    }

    public function testSingleRulePasses()
    {
        $schema = rule('name.required', 'name', required());
        $this->assertNull(assert(['name' => 'Freddy'], $schema));
    }

    public function testRuleMultipleCallbacksFails()
    {
        $this->setExpectedException('\plato\PlatoException');
        $schema = rule('name.valid', 'name', [required(), minlength(8)]);
        assert(['name' => 'Freddy'], $schema);
    }

    public function testRuleMultipleCallbacksPasses()
    {
        $schema = rule('name.valid', 'name', [required(), minlength(4)]);
        $this->assertNull(assert(['name' => 'Freddy'], $schema));
    }

    public function testRuleMultipleKeysFails()
    {
        $this->setExpectedException('\plato\PlatoException');
        $schema = rule('names.matching', ['name','repeat'], identical());
        assert(['name' => 'Freddy'], $schema);
    }

    public function testRuleMultipleKeysPasses()
    {
        $schema = rule('name.matching', ['name','repeat'], identical());
        $this->assertNull(assert(['name' => 'Freddy', 'repeat' => 'Freddy'], $schema));
    }

    public function testRuleMultipleKeysMultipleCallbacksFails()
    {
        $this->setExpectedException('\plato\PlatoException');
        $schema = rule('names.matching.length', ['name','repeat'], identical(), all(minlength(4)));
        assert(['name' => 'Freddy'], $schema);
    }

    public function testRuleMultipleKeysMultipleCallbacksPasses()
    {
        $schema = rule('names.matching.length', ['name','repeat'], identical(), all(minlength(4)));
        $this->assertNull(assert(['name' => 'Freddy', 'repeat' => 'Freddy'], $schema));
    }

    public function testMultipleRulesFails()
    {
        $this->setExpectedException('\plato\PlatoException');
        $schema = [
            rule('name.required', 'name', required()),
            rule('profession.required', 'profession', required())
        ];

        assert(['absent' => 'data'], $schema);
    }

    public function testMultipleRulesPasses()
    {
        $schema = [
            rule('name.required', 'name', required()),
            rule('profession.required', 'profession', required())
        ];

        $this->assertNull(assert(['name' => 'Bill', 'profession' => 'Potter'], $schema));
    }
}
