<?php

namespace plato;

function evaluate($rules, array $values) {
    $rules = callables($rules);
    return array_reduce($rules, function($passes, $rule) use ($values) {
        return $passes && call_user_func_array($rule, $values ?: [null]);
    }, true);
}
