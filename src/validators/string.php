<?php

namespace plato;

function minlength($length) {
    return function($value) use ($length) {
        return strlen($value) >= $length;
    };
}

function maxlength($length) {
    return function($value) use ($length) {
        return strlen($value) <= $length;
    };
}

function matches($regex) {
    return function ($value) use ($regex) {
        return preg_match($regex, $value);
    };
}

function excludes($regex) {
    return function ($value) use ($regex) {
        return !preg_match($regex, $value);
    };
}

function alphanumeric() {
    return function ($value) {
        return !preg_match('/[^a-z0-9]/i', $value);
    };
}


function email() {
    return function ($v) {
        return (bool) filter_var($v, FILTER_VALIDATE_EMAIL);
    };
}

function ip() {
    return function ($v) {
        return (bool) filter_var($v, FILTER_VALIDATE_IP);
    };
}

function url() {
    return function ($value) {
        return (bool) filter_var($value, FILTER_VALIDATE_URL);
    };
}
