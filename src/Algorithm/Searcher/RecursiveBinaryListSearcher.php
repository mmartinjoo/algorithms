<?php

namespace Jmweb\Algorithm\Searcher;

use Jmweb\Algorithm\IList;
use Jmweb\Algorithm\Searcher\ListSearcher;
use Jmweb\Algorithm\Comparator\Comparator;

class RecursiveBinaryListSearcher implements ListSearcher
{
    /**
     * @var Jmweb\Algorithm\Comparator\Comparator
     */
    protected $_comparator;
    
    /**
     * @param Jmweb\Algorithm\Comparator\Comparator
     * @return void
     */
    public function __construct(Comparator $_comparator)
    {
        $this->_comparator = $_comparator;
    }

    /**
     * @param Jmweb\Algorithm\IList $list 
     * @param mixed $key 
     * @return int
     */
    public function search(IList $list, $key)
    {
        return $this->searchRecursively($list, $key, 0, $list->size() - 1);
    }

    /**
     * @param Jmweb\Algorithm\IList $list 
     * @param mixed $key 
     * @param int $left 
     * @param int $right 
     * @return int
     */
    protected function searchRecursively(IList $list, $key, $left, $right)
    {        
        // We returns the appropriate index - 1. When key should be in 0, then it returns -1
        if ($left > $right) {
            return -($left + 1);
        }

        $index = $left + intval(($right - $left) / 2);
        $cmp = $this->_comparator->compare($list->get($index), $key);

        if ($cmp < 0) {
            $index = $this->searchRecursively($list, $key, $index + 1, $right);
        } elseif ($cmp > 0) {
            $index = $this->searchRecursively($list, $key, $left, $index - 1);
        } 

        return $index;
    }
}
