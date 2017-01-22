<?php

namespace Jmweb\Algorithm;

use Jmweb\Exception\EmptyQueueException;

class ListFifoQueue implements Queue
{
    protected $_list;

    public function setList(IList $list)
    {
        $this->_list = $list;
        return $this;
    }

    public function __construct()
    {
        $this->_list = new LinkedList;
    }

    /**
     * @param IList $list 
     * @return Queue
     */
    public static function createWithList(IList $list)
    {
        $queue = new ListFifoQueue;
        $queue->setList($list);

        return $queue;
    }

    /**
     * @param mixed $value 
     * @return void
     */
    public function enqueue($value)
    {
        $this->_list->add($value);
    }

    /**
     * @return mixed
     */
    public function dequeue()
    {
        if ($this->isEmpty()) {
            throw new EmptyQueueException;
        }

        return $this->_list->delete(0);
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
