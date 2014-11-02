<?php

namespace plato;

function istrue() {
    return function ($value) {
        return $value === true;
    };
}

function isfalse() {
    return function ($value) {
        return $value === false;
    };
}

function istrueish() {
    return function ($value) {
        return $value == true;
    };
}

function isfalsy() {
    return function ($value) {
        return $value == false;
    };
}
