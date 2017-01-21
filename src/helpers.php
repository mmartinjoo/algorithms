<?php

function dump() {
    $args = func_get_args();
    foreach ($args as $arg) {
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
    }
}
