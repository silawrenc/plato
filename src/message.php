<?php

namespace plato;

function message($message, $rules) {
    return function ($value) use ($message, $rules) {
        return evaluate((array) $rules, (array) $value) ? null : $message;
    };
}
