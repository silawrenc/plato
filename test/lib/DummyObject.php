<?php

namespace plato\test;

class DummyObject
{
    public static function required($value)
    {
        $fn = \plato\required();
        return $fn($value);
    }
}
