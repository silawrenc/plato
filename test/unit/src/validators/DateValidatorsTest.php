<?php

namespace plato;

use PHPUnit_Framework_TestCase as TestCase;
use DateTime;
use DateTimeZone;

class DateValidatorsTest extends TestCase
{
    public function testData()
    {
        return [
            [before($this->year(1998)), $this->year(1998), false],
            [before($this->year(1999)), $this->year(1998), true],
            [after($this->year(1998)), $this->year(1998), false],
            [after($this->year(1998)), $this->year(1999), true],
            [between($this->year(1998), $this->year(2000)), $this->year(1997), false],
            [between($this->year(1998), $this->year(2000)), $this->year(1999), true]
        ];
    }

    protected function year($year)
    {
        return new DateTime("{$year}-01-01", new DateTimeZone('UTC'));
    }
}
