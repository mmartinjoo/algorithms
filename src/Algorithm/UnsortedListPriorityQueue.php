<?php

namespace Jmweb\Algorithm;

use Jmweb\Algorithm\Comparator\Comparator;
use Jmweb\Algorithm\IList;
use Jmweb\Exception\EmptyQueueException;

class UnsortedListPriorityQueue implements Queue
{
    /**
     * @var Jmweb\Algorithm\IList
     */
    protected $_list;

    /**
     * @var Jmweb\Algorithm\Comparator\Comparator
     */
    protected $_comparator;

    /**
     * @param IList $_list 
     * @param Comparator $_comparator 
     * @return void
     */
    public function __construct(Comparator $_comparator)
    {
        $this->_list = new LinkedList;
        $this->_comparator = $_comparator;
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
            throw new EmptyQueueException();
        }

        return $this->_list->delete($this->getIndexOfLargestElement());
    }

    /**
     * @return int
     */
    protected function getIndexOfLargestElement()
    {
        $index = 0;
        for ($i = 1; $i < $this->_list->size(); $i++) {
            if ($this->_comparator->compare($this->_list->get($i), 
                                            $this->_list->get($index)) > 0) {
                $index = $i;
            }
        }

        return $index;
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
     * @return int
     */
    public function isEmpty()
    {
        return $this->_list->isEmpty();
    }
}
