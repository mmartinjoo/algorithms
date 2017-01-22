<?php

namespace Jmweb\Algorithm;

use Jmweb\Exception\IndexOutOfBoundsException;
use Jmweb\Algorithm\IList;
use Jmweb\Algorithm\ArrayIterator;
use Jmweb\Algorithm\AbstractList;

class ArrayList extends AbstractList
{
    /**
     * @var array
     */
    protected $_array = [];

    /**
     * @var int
     */
    protected $_size = 0;

    public function __construct()
    {
        $this->clear(); 
    }

    /**
     * @return Jmweb\Algorithm\ArrayIterator
     */
    public function iterator()
    {
        return new ArrayIterator($this->_array); 
    }

    public function clear()
    {
        $this->_size = 0;
        $this->_array = [];
    }

    /**
     * @param int $index 
     * @param mixed $value 
     * @return void
     */
    public function insert($index, $value)
    {
        $this->checkOutOfBounds($index);
        $this->_array[$index] = $value;
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
     * @return int
     */
    public function delete($index)
    {
        $this->checkOutOfBounds($index);
        $this->checkIsset($index);
        $value = $this->_array[$index];

        unset($this->_array[$index]);
        $this->_size--;

        return $value;
    }

    /**
     * @param mixed $value 
     * @return bool
     */
    public function deleteByValue($value)
    {
        $index = $this->indexOf($value);
        if ($index != -1) {
            $this->delete($index);
            return true;
        }

        return false;
    }

    /**
     * @param int $index 
     * @param mixed $value 
     * @return mixed    Original value at $index
     */
    public function set($index, $value)
    {
        $this->checkOutOfBounds($index);
        $this->checkIsset($index);
        $oldValue = $this->_array[$index];
        $this->_array[$index] = $value;

        return $oldValue;
    }

    /**
     * @param int $index 
     * @return mixed
     */
    public function get($index)
    {
        $this->checkOutOfBounds($index);
        $this->checkIsset($index);
        return $this->_array[$index];
    }

    /**
     * @param mixed $value 
     * @return bool
     */
    public function contains($value)
    {
        return ($this->indexOf($value) != -1); 
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
        return ($this->_size == 0); 
    }

    /**
     * @param int $index 
     * @throws Jmweb\Exception\IndexOutOfBoundsException
     * @return void
     */
    protected function checkOutOfBounds($index)
    {
        if ($index < 0) {
            throw new IndexOutOfBoundsException($index);
        } 
    }

    /**
     * @param int $index 
     * @throws Jmweb\Exception\IndexOutOfBoundsException
     * @return void
     */
    protected function checkIsset($index)
    {
        if (!isset($this->_array[$index])) {
            throw new IndexOutOfBoundsException($index);
        }
    }

    /**
     * @return int
     */
    protected function getMinimumIndex()
    {
        $indexes = array_keys($this->_array);
        return min($indexes);
    }
}
