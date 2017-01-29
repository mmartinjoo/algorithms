<?php

namespace Jmweb\Algorithm;

use Jmweb\Exception\IndexOutOfBoundsException;
use Jmweb\Algorithm\IList;
use Jmweb\Algorithm\ValueIterator;
use Jmweb\Algorithm\Element;
use Jmweb\Algorithm\LinkedList;

class InsertCountingLinkedList extends LinkedList
{
    /**
     * @var int
     */
    protected $_insertCount = 0;

    public function getInsertCount() { return $this->_insertCount; }
    public function setInsertCount($insertCount) { $this->_insertCount = 0; }

    /**
     * @param int $index 
     * @param mixed $value 
     * @return void
     */
    public function insert($index, $value)
    {
        parent::insert($index, $value);
        $this->_insertCount++;
    }

    /**
     * @param int $index 
     * @param mixed $value 
     * @return void
     */
    public function set($index, $value)
    {
        $this->_insertCount++;
        return parent::set($index, $value);
    }
}
