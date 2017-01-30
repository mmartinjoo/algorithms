<?php

namespace Jmweb\Algorithm\Sorter;

use Jmweb\Algorithm\IList;
use Jmweb\Algorithm\Sorter\ListSorter;
use Jmweb\Algorithm\Comparator\Comparator;
use Jmweb\Algorithm\LinkedList;

class MergeSortListSorter implements ListSorter
{
    /**
     * @var Jmweb\Algorithm\Comparator\Comparator
     */
    protected $_comparator;
    
    /**
     * @param Jmweb\Algorithm\Comparator\Comparator $_comparator 
     * @return void
     */
    public function __construct(Comparator $_comparator)
    {
        $this->_comparator = $_comparator;
    }

    /**
     * @param Jmweb\Algorithm\IList $list 
     * @return Jmweb\Algorithm\IList
     */
    public function sort(IList $list)
    {
        return $this->mergesort($list, 0, $list->size() - 1);
    }

    /**
     * @param IList $list 
     * @param int $leftIndex 
     * @param int $rightIndex 
     * @return IList
     */
    protected function mergesort(IList $list, $leftIndex, $rightIndex)
    {
        if ($leftIndex == $rightIndex) {
            $result = new LinkedList;
            $result->add($list->get($leftIndex));

            return $result;            
        }

        $splitIndex = $leftIndex + intval(($rightIndex - $leftIndex) / 2);
        $left = $this->mergesort($list, $leftIndex, $splitIndex);
        $right = $this->mergesort($list, $splitIndex + 1, $rightIndex);

        return $this->merge($left, $right);
    }

    /**
     * @param Jmweb\Algorithm\IList $left 
     * @param Jmweb\Algorithm\IList $right 
     * @return Jmweb\Algorithm\IList 
     */
    protected function merge(IList $left, IList $right)
    {
        $result = new LinkedList;
        $l = $left->iterator();
        $r = $right->iterator();

        $l->first();
        $r->first();

        while (!($l->isDone() && $r->isDone())) {
            if ($l->isDone()) {
                $result->add($r->current());
                $r->next();
            } elseif ($r->isDone()) {
                $result->add($l->current());
                $l->next();
            } elseif ($this->_comparator->compare($l->current(), $r->current()) <= 0) {
                $result->add($l->current());
                $l->next();
            } else {
                $result->add($r->current());
                $r->next();
            } 
        }

        return $result;
    }
}
