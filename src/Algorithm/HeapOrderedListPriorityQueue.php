<?php

namespace Jmweb\Algorithm;

use Jmweb\Algorithm\Comparator\Comparator;
use Jmweb\Algorithm\IList;
use Jmweb\Exception\EmptyQueueException;

class HeapOrderedListPriorityQueue implements Queue
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
        $this->swim($this->_list->size() - 1);
    }

    public function dequeue()
    {
        if ($this->isEmpty()) {
            throw new EmptyQueueException;
        }

        $result = $this->_list->get(0);
        if ($this->_list->size() > 1) {
             $this->_list->set(0, $this->_list->get($this->_list->size() - 1));
             $this->sink(0);
        }

        $this->_list->delete($this->_list->size() - 1);
        return $result;
    }

    protected function sink($index)
    {
        $left = ($index * 2) + 1;
        $right = ($index * 2) + 2;

        // No more children, we're done
        if ($left >= $this->_list->size()) {
            return;
        }

        $largestChild = $left;
        if ($right < $this->_list->size() 
            && $this->_comparator->compare($this->_list->get($right), 
                                            $this->_list->get($left) > 0)) {
            $largestChild = $right;
        }

        if ($this->_comparator->compare($this->_list->get($largestChild), 
                                        $this->_list->get($index)) > 0) {

            $this->swap($largestChild, $index);
            $this->sink($largestChild);
        }
    }

    /**
     * @param int $index 
     * @return void
     */
    protected function swim($index)
    {
        if ($index == 0) {
            return;
        }

        $parent = intval(($index - 1) / 2);
        if ($this->_comparator->compare($this->_list->get($index),
                                        $this->_list->get($parent)) > 0) {

            $this->swap($index, $parent);
            $this->swim($parent);
        }
    }

    /**
     * @param int $index1 
     * @param int $index2 
     * @return void
     */
    protected function swap($index1, $index2)
    {
        $tmp = $this->_list->get($index1);
        $this->_list->set($index1, $this->_list->get($index2));
        $this->_list->set($index2, $tmp);
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
