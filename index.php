<?php

use Jmweb\Algorithm\ArrayIterator;
use Jmweb\Algorithm\ReverseIterator;
use Jmweb\Algorithm\ArrayList;

error_reporting(E_ALL);
require 'vendor/autoload.php';

/* $array = [1 => 1, 2 => 2, 3 => 3]; */

/* $iterator = new ArrayIterator($array); */
/* for ($elem = $iterator->first(); !$iterator->isDone(); $iterator->next()) { */
/*     var_dump($iterator->current()); */
/* } */

/* $reverseIterator = new ReverseIterator($iterator); */
/* for ($elem = $reverseIterator->first(); !$reverseIterator->isDone(); $reverseIterator->next()) { */
/*     var_dump($reverseIterator->current()); */
/* } */

$list = new ArrayList;

dump($list->isEmpty());

$list->add('Martin');
$list->add('Marcsi');
$list->add('Béla');

$iterator = $list->iterator();
for ($iterator->first(); !$iterator->isDone(); $iterator->next()) {
    dump($iterator->current());
}

dump($list->get(0));
dump($list->indexOf('Marcsi'));
dump($list->indexOf('hello'));
dump($list->contains('Béla'));
dump($list->contains('Hello'));
dump($list->size());
dump($list->isEmpty());

dump($list->delete(2));
dump($list->size());

dump($list->deleteByValue('Martin'));
dump($list->size());

dump($list->set(1, 'MARCSI'));
dump($list->get(1));

dump($list->clear());
dump($list->size());
dump($list->isEmpty());
