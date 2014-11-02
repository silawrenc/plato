<?php

namespace plato;

function evaluate(array $rules, array $values) {
    return array_reduce($rules, function($passes, $rule) use ($values) {
        return $passes && call_user_func_array($rule, $values ?: [null]);
    }, true);
}
