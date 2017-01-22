<?php

use Jmweb\Algorithm\ArrayIterator;
use Jmweb\Algorithm\ReverseIterator;
use Jmweb\Algorithm\ArrayList;
use Jmweb\Algorithm\LinkedList;
use Jmweb\Algorithm\ListFifoQueue;

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

/* $list = new ArrayList; */

/* dump($list->isEmpty()); */

/* $list->add('Martin'); */
/* $list->add('Marcsi'); */
/* $list->add('Béla'); */

/* $iterator = $list->iterator(); */
/* for ($iterator->first(); !$iterator->isDone(); $iterator->next()) { */
    /* dump($iterator->current()); */
/* } */

/* dump($list->get(0)); */
/* dump($list->indexOf('Marcsi')); */
/* dump($list->indexOf('hello')); */
/* dump($list->contains('Béla')); */
/* dump($list->contains('Hello')); */
/* dump($list->size()); */
/* dump($list->isEmpty()); */

/* dump($list->delete(2)); */
/* dump($list->size()); */

/* dump($list->deleteByValue('Martin')); */
/* dump($list->size()); */

/* dump($list->set(1, 'MARCSI')); */
/* dump($list->get(1)); */

/* dump($list->clear()); */
/* dump($list->size()); */
/* dump($list->isEmpty()); */

/* $list = new LinkedList; */
/* $list->add(1); */
/* $list->add(2); */

/* $iterator = $list->iterator(); */
/* for ($iterator->first(); !$iterator->isDone(); $iterator->next()) { */
/*     dump($iterator->current()); */
/* } */

/* dump($list->size()); */

/* dump($list->delete(1)); */
/* dump($list->size()); */

/* dump($list->deleteByValue(1)); */
/* dump($list->size()); */
/* dump($list->isEmpty()); */

/* $list = new ArrayList; */

/* $list->add(1); */
/* $list->add(2); */
/* $list->add(3); */

/* $otherList = new ArrayList; */

/* $otherList->add(1); */
/* $otherList->add(2); */
/* $otherList->add(3); */

/* dump($list->equals($otherList)); */


/* echo $list; */

/* $otherList->add('Martin'); */
/* $otherList->add('Marcsi'); */

/* echo $otherList; */

/* $otherList->clear(); */

/* echo $otherList; */

$queue = new ListFifoQueue;

$queue->enqueue('Marcsi');
$queue->enqueue('Martin');
$queue->enqueue('Béla');

dump($queue->dequeue());
dump($queue->dequeue());
dump($queue->dequeue());

dump($queue->isEmpty());
