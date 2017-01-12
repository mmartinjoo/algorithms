<?php

use Jmweb\Some;
use Jmweb\Algorithm\ArrayIterator;
use Jmweb\Algorithm\ReverseIterator;

error_reporting(E_ALL);
require 'vendor/autoload.php';

$array = [1, 2, 3];

$iterator = new ArrayIterator($array);
for ($elem = $iterator->first(); !$iterator->isDone(); $iterator->next()) {
    var_dump($iterator->current());
}

$reverseIterator = new ReverseIterator($iterator);
for ($elem = $reverseIterator->first(); !$reverseIterator->isDone(); $reverseIterator->next()) {
    var_dump($reverseIterator->current());
}
