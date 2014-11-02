<?php

namespace plato;

function validate($candidate, $schema) {
    return array_values(array_filter(array_map(function ($rule) use ($candidate) {
        return call_user_func($rule, $candidate);
    }, (array) $schema)));
}
