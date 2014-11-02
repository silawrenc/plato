<?php

namespace plato;

function lessthan($max) {
    return function($value) use ($max) {
        return $value < $max;
    };
}

function lessthanequal($max) {
    return function($value) use ($max) {
        return $value <= $max;
    };
}

function morethan($min) {
    return function($value) use ($min) {
        return $value > $min;
    };
}

function morethanequal($min) {
    return function($value)  use ($min) {
        return $value >= $min;
    };
}

function range($min, $max) {
    return function ($v) use($min, $max) {
        return $min <= $v && $v < $max;
    };
};

function xrange($min, $max) {
    return function ($v) use($min, $max) {
        return $min < $v && $v < $max;
    };
};
