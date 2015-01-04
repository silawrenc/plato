<?php

namespace plato;

function callables($fns) {
    return is_callable($fns) ? [$fns] : $fns;
}
