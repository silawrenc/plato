<?php

namespace plato;

function oneof ($a, $b) {
    $args = func_get_args();
    if (count($args) > 2) {
        return oneof(array_pop($args), $args);
    }
    return function($keys) use ($a, $b) {
        $keys = func_get_args();
        return call_user_func_array($a, $keys) || call_user_func_array($b, $keys);
    };
}

function oneofx ($a, $b) {
    $args = func_get_args();
    if (count($args) > 2) {
        return oneofx(array_pop($args), $args);
    }
    return function($keys) use ($a, $b) {
        $keys = func_get_args();
        $resA = call_user_func_array($a, $keys);
        $resB = call_user_func_array($b, $keys);
        return ($resA || $resB) && !($resA && $resB);
    };
}

function allof($a, $b) {
    $args = func_get_args();
    return function ($keys) use ($args) {
        $keys = func_get_args();
        return count(array_filter(array_map(function ($arg) use ($keys) {
            return call_user_func_array($arg, $keys);
        }, $args))) === count($args);
    };
}

function noneof($a, $b) {
    $args = func_get_args();
    return function ($keys) use ($args) {
        $keys = func_get_args();
        return !(bool) array_filter(array_map(function ($arg) use ($keys) {
            return call_user_func_array($arg, $keys);
        }, $args));
    };
}

function not($a) {
    return function($keys) use ($a) {
        $keys = func_get_args();
        return !call_user_func_array($a, $keys);
    };
}

function all($rule) {
    return function($keys) use ($rule) {
        $keys = func_get_args();
        return count(array_filter(array_map(function($key) use ($rule) {
            return call_user_func($rule, $key);
        }))) === count($keys);
    };
}

function schema(array $schema) {
    return function($arr) use ($schema) {
        return empty(validate($arr, $schema));
    };
}
