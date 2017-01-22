<?php

namespace Jmweb\Algorithm;

use Jmweb\Exception\IndexOutOfBoundsException;
use Jmweb\Algorithm\IList;
use Jmweb\Algorithm\ValueIterator;
use Jmweb\Algorithm\Element;
use Jmweb\Algorithm\AbstractList;

class LinkedList extends AbstractList
{
    protected $_headAndTail;

    /**
     * @var int
     */
    protected $_size = 0;

    public function getHeadAndTail() { return $this->_headAndTail; }

    public function __construct()
    {
        $this->clear();
    }

    /**
     * @return Jmweb\Algorithm\Iterator
     */
    public function iterator()
    {
        return new ValueIterator($this);
    }

    /**
     * @param int $index 
     * @param mixed $value 
     * @return void
     */
    public function insert($index, $value)
    {
        $this->checkOutOfBounds($index);
        $element = new Element($value);
        $element->attachBefore($this->getElement($index));
        $this->_size++;
    }

    /**
     * @param mixed $value 
     * @return void
     */
    public function add($value)
    {
        $this->insert($this->_size, $value);
    }

    /**
     * @param int $index 
     * @return mixed
     */
    public function get($index)
    {
        $this->checkOutOfBoundsInclusive($index);
        return $this->getElement($index)->getValue();
    }

    /**
     * @param int $index 
     * @param mixed $value 
     * @return mixed        Old value at $index
     */
    public function set($index, $value)
    {
        $this->checkOutOfBoundsInclusive($index);
        $element = $this->getElement($index);
        $oldValue = $element->getValue();
        $element->setValue($value);

        return $oldValue;
    }

    /**
     * @param mixed $value 
     * @return bool
     */
    public function contains($value)
    {
        return $this->indexOf($value) != -1;
    }

    /**
     * @param int $index 
     * @return mixed
     */
    public function delete($index)
    {
        $this->checkOutOfBoundsInclusive($index);
        $element = $this->getElement($index);
        $element->detach();
        $this->_size--;

        return $element->getValue();
    }

    /**
     * @param mixed $value 
     * @return bool
     */
    public function deleteByValue($value)
    {
        for ($e = $this->_headAndTail->getNext(); 
                $e != $this->_headAndTail; 
                $e = $e->getNext()) {

            if ($value == $e->getValue()) {
                $e->detach();
                $this->_size--;
                return true;
            }
        }

        return false;
    }

    /**
     * @return int
     */
    public function size()
    {
        return $this->_size;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->_size == 0;
    }

    public function clear()
    {
        $this->_headAndTail = new Element(null);
        $this->_headAndTail->setPrevious($this->_headAndTail);
        $this->_headAndTail->setNext($this->_headAndTail);
        $this->_size = 0;
    }

    /**
     * @param int $index 
     * @return Jmweb\Algorithm\Element
     */
    protected function getElement($index)
    {
        // Head
        if ($index == 0) 
            return $this->_headAndTail->getNext();

        // Tail
        if ($index == $this->_size - 1)
            return $this->_headAndTail->getPrevious();

        $half = (int)($this->_size / 2);

        // If $index less then the half of the list, it starts from the head, otherwise it starts from tail
        if ($index <= $half) {
            $element = $this->getElementFromHead($index);
        } else {
            $element = $this->getElementFromTail($index);
        }

        return $element;
    }

    /**
     * @param int $index 
     * @return Jmweb\Algorithm\Element
     */
    protected function getElementFromHead($index)
    {
        $element = $this->_headAndTail->getNext();
        for ($i = $index; $i > 0; $i--) {
            $element = $element->getNext();
        }

        return $element;
    }

    /**
     * @param int $index 
     * @return Jmweb\Algorithm\Element
     */
    protected function getElementFromTail($index)
    {
        $element = $this->_headAndTail->getPrevious();
        for ($i = $index; $i > 0; $i--) {
            $element = $element->getPrevious();
        }

        return $element;
    }


    /**
     * @param int $index 
     * @throws IndexOutOfBoundsException
     * @return void
     */
    protected function checkOutOfBounds($index)
    {
        if ($index < 0 || $index > $this->_size) {
            throw new IndexOutOfBoundsException($index);
        }
    }

    protected function checkOutOfBoundsInclusive($index)
    {
        if ($index < 0 || $index >= $this->_size) {
            throw new IndexOutOfBoundsException($index);
        }
    }

    /**
     * @return int
     */
    protected function getMinimumIndex()
    {
        return 0;
    }
}
