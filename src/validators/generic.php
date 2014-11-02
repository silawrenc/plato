<?php

namespace plato;

function required() {
    return function ($value) {
        return ($value !== null) && ($value !== '');
    };
}

function forbidden() {
    return function($v) {
        return $v === null;
    };
}

function equals($expected) {
    return function($value) use ($expected) {
        return $value === $expected;
    };
}

function whitelist(array $values) {
    return function($v) use ($values) {
        return in_array($v, $values);
    };
}

function blacklist(array $values) {
    return function($v) use ($values) {
        return !in_array($v, $values);
    };
}
