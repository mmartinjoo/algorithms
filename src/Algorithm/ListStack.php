<?php

namespace Jmweb\Algorithm;

use Jmweb\Algorithm\Stack;
use Jmweb\Exception\EmptyStackException;
use Jmweb\Exception\EmptyQueueException;

class ListStack implements Stack
{
    /**
     * @var Jmweb\Algorithm\List
     */
    protected $_list;

    public function __construct()
    {
        $this->_list = new LinkedList;
    }

    /**
     * @param mixed $value 
     * @return void
     */
    public function push($value)
    {
        $this->_list->add($value);
    }

    public function enqueue($value)
    {
        $this->push($value);
    }

    /**
     * @return mixed
     * @throws Jmweb\Exception\EmptyStackException
     */
    public function pop()
    {
        if ($this->isEmpty()) {
            throw new EmptyStackException;
        }

        return $this->_list->delete($this->size() - 1);
    }

    /**
     * @return mixed
     * @throws Jmweb\Exception\EmptyQueueException
     */
    public function dequeue()
    {
        try {
            return $this->pop();
        } catch (EmptyStackException $ex) {
            throw new EmptyQueueException;
        }
    }

    /**
     * @return mixed
     */
    public function peek()
    {
        $result = $this->pop();
        $this->push($result);

        return $result;
    }

    public function clear()
    {
        $this->_list->clear();
    }

    /**
     * @return int
     */
    public function size()
    {
        return $this->_list->size();
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->_list->isEmpty();
    }
}
