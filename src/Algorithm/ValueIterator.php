<?php

namespace Jmweb\Algorithm;

use Jmweb\Algorithm\Iterator;
use Jmweb\Algorithm\Element;
use Jmweb\Algorithm\LinkedList;
use Jmweb\Exception\IteratorOutOfBoundsException;

class ValueIterator implements Iterator
{
    /**
     * @var Jmweb\Algorithm\LinkedList
     */
    protected $_list;

    /**
     * @var Jmweb\Algorithm\Element
     */
    protected $_current;

    /**
     * @param LinkedList $list 
     */
    public function __construct(LinkedList $list)
    {
        $this->_list = $list;
        $this->_current = $this->_list->getHeadAndTail();
    }

    public function first()
    {
        $this->_current = $this->_list->getHeadAndTail()->getNext();
    }

    public function last()
    {
        $this->_current = $this->_list->getHeadAndTail()->getPrevious();
    }

    /**
     * @return bool
     */
    public function isDone()
    {
        return $this->_current == $this->_list->getHeadAndTail();
    }

    public function next()
    {
        $this->_current = $this->_current->getNext();
    }

    public function previous()
    {
        $this->_current = $this->_current->getPrevious();
    }

    /**
     * @return mixed
     */
    public function current()
    {
        if ($this->isDone()) {
            throw new IteratorOutOfBoundsException();
        }

        return $this->_current->getValue();
    }
}
