<?php

namespace Jmweb\Algorithm\Comparator;

use Jmweb\Algorithm\Comparator\Comparator;

class CallCountingComparator implements Comparator
{
    /**
     * @var Jmweb\Algorithm\Comparator\Comparator
     */
    protected $_comparator;

    /**
     * @var int
     */
    protected $_count = 0;

    /**
     * @return int  
     */
    public function getCount() { return $this->_count; }

    /**
     * @param Jmweb\Algorithm\Comparator\Comparator $_comparator 
     * @return void
     */
    public function __construct($_comparator)
    {
        $this->_comparator = $_comparator;
    }

    /**
     * @param mixed $left 
     * @param mixed $right 
     * @return mixed
     */
    public function compare($left, $right)
    {
        $this->_count++;
        return $this->_comparator->compare($left, $right);
    }
}
