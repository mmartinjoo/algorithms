<?php

namespace Jmweb\Algorithm;

use Jmweb\Algorithm\Iterator;
use Jmweb\Exception\IteratorOutOfBoundsException;

class ArrayIterator implements Iterator
{
    /**
     * @var array
     */
    protected $_array;

    /**
     * @var int
     */
    protected $_start;

    /**
     * @var int
     */
    protected $_end;

    /**
     * @var int
     */
    protected $_current = -1;

    public function getArray() { return $this->_array; }
    public function getStart() { return $this->_start; }
    public function getEnd() { return $this->_end; }

    /**
     * @param array $array
     */
    public function __construct(array $array, $start = 0, $length = null)
    {
        $this->_array = $array;

        if ($length) {
            $this->_start = $start;
            $this->_end = $start + $length - 1;
        } else {
            $this->_start = min(array_keys($array));
            $this->_end = max(array_keys($array));
        }
    }

    /**
     * @param array $array
     * @param int $start
     * @param int $length
     */
    public static function createWithSubArray(array $array, $start, $length)
    {
        $subArray = array_slice($array, $start, $length);
        return new ArrayIterator($subArray, $start, $start + $length - 1);
    }

    public function first()
    {
        $this->_current = $this->_start;
    }

    public function last()
    {
        $this->_current = $this->_end;
    }

    public function next()
    {
        $this->_current++;
    }

    public function previous()
    {
        $this->_current--;
    }

    /**
     * @return bool
     */
    public function isDone()
    {
        return ($this->_current < $this->_start 
            || $this->_current > $this->_end);
    }

    /**
     * @return mixed
     * @throws IteratorOutOfBoundsException
     */
    public function current()
    {
        if ($this->isDone()) {
            throw new IteratorOutOfBoundsException(); 
        }

        return $this->_array[$this->_current];
    }
}
