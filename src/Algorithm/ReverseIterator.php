<?php

namespace Jmweb\Algorithm;

use Jmweb\Algorithm\Iterator;

class ReverseIterator implements Iterator
{
    protected $_iterator;

    public function __construct($_iterator)
    {
        $this->_iterator = $_iterator;
    }

    public function isDone()
    {
        return $this->_iterator->isDone();
    }

    public function current()
    {
        return $this->_iterator->current();
    }

    public function first()
    {
        $this->_iterator->last();
    }

    public function last()
    {
        $this->_iterator->first();
    }

    public function next()
    {
        $this->_iterator->previous();
    }

    public function previous()
    {
        $this->_iterator->next();
    }
}
