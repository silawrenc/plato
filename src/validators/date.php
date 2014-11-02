<?php

namespace plato;

use DateTime;
use DateTimeZone;

function before(DateTime $date = null) {
    $date = $date ?: new DateTime('now', new DateTimeZone('UTC'));
    return function ($value) use ($date) {
        return $value < $date;
    };
}

function after($date = null) {
    $date = $date ?: new DateTime('now', new DateTimeZone('UTC'));
    return function ($value)  use ($date) {
        return $value > $date;
    };
}

function between(DateTime $before, DateTime $after) {
    return function ($value)  use ($before, $after) {
        return $before < $value && $value < $after;
    };
}
