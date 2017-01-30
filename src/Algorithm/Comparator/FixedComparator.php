<?php

namespace Jmweb\Algorithm\Comparator;

use Jmweb\Algorithm\Comparator\Comparator;

class FixedComparator implements Comparator
{
    /**
     * @var int
     */
    protected $_result;

    /**
     * @param int $_result 
     * @return void
     */
    public function __construct($_result)
    {
        $this->_result = $_result;
    }

    /**
     * @param mixed $left 
     * @param mixed $right 
     * @return int
     */
    public function compare($left, $right)
    {
        return $this->_result;
    }
}
