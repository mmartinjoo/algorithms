<?php

namespace Jmweb\Algorithm\Comparator;

use Jmweb\Algorithm\Comparator\Comparator;
use Jmweb\Algorithm\IList;
use Jmweb\Algorithm\LinkedList;

class CompoundComparator implements Comparator
{
     /**
      * @var Jmweb\Algorithm\IList;
      */
     protected $_comparators;

     public function __construct()
     {
         $this->_comparators = new LinkedList;
     }

     /**
      * @param Jmweb\Algorithm\Comparator\Comparator $comparator 
      * @return void
      */
    public function addComparator(Comparator $comparator) 
    {
        $this->_comparators->add($comparator);
    }

    /**
     * @param mixed $left 
     * @param mixed $right 
     * @return int
     */
    public function compare($left, $right)
    {
        $it = $this->_comparators->iterator();
        for ($it->first(); !$it->isDone(); $it->next()) {
            $comparator = $it->current();
            $compare = $comparator->compare($left, $right);

            if ($compare != 0) {
                return $compare;
            }
        }

        return 0;
    }
}
