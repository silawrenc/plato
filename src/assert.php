<?php

namespace plato;

function assert($candidate, $schema) {
    array_map(function ($rule) use ($candidate) {
        $message = call_user_func($rule, $candidate);
        if ($message) {
            throw new PlatoException($message);
        };
    }, (array) $schema);
}
