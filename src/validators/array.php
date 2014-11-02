<?php

namespace plato;

function containskeys(array $keys) {
    return function ($value) use ($keys) {
        return !(bool) array_diff($keys, array_keys($value));
    };
}

function containsvalues(array $values) {
    return function ($value) use ($values) {
        return !(bool) array_diff($values, $value);
    };
}
