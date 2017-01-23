<?php

namespace Jmweb\Algorithm\Comparator;
use Jmweb\Algorithm\Comparator\Comparator;
use Jmweb\Algorithm\Comparator\NaturalComparator;
use Jmweb\Algorithm\Comparator\Text;

class ReverseComparator implements Comparator
{
    protected $_comparator;

    public function __construct(NaturalComparator $comparator)
    {
        $this->_comparator = $comparator;
    }

     /**
      * @param mixed $left 
      * @param mixed $right 
      * @return int
      */
    public function compare($left, $right)
    {
        return $this->_comparator->compare($right, $left);
    }
}
