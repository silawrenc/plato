<?php

namespace plato;

function rule($message, $keys, $rules) {
    $keys = (array) $keys;
    $rules = (array) $rules;
    $message = (string) $message;

    return function (array $data) use ($message, $keys, $rules) {
        $values = array_map(function ($key) use ($data) {
            return array_key_exists($key, $data) ? $data[$key] : null;
        }, $keys);

        return evaluate($rules, $values) ? null : $message;
    };
}
