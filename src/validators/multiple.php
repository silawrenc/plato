<?php

namespace plato;

function identical() {
    return function ($first, $second) {
        return $first === $second;
    };
};

function either() {
    return function ($first, $second) {
        return required($first) || required($second);
    };
}

function exclusive() {
    return function ($first, $second) {
        return (call_user_func(required(), $first) xor call_user_func(required(), $first));
    };
}

function comparisonlessthan() {
    return function ($first, $second) {
        return $first < $second;
    };
}

function comparisonlessthanequal() {
    return function ($first, $second) {
        return $first <= $second;
    };
}

function comparisonmorethan() {
    return function ($first, $second) {
        return $first > $second;
    };
}

function comparisonmorethanequal() {
    return function ($first, $second) {
        return $first >= $second;
    };
}
