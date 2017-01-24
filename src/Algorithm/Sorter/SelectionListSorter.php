<?php

namespace Jmweb\Algorithm\Sorter;

use Jmweb\Algorithm\IList;
use Jmweb\Algorithm\Sorter\ListSorter;
use Jmweb\Algorithm\Comparator\Comparator;

class SelectionListSorter implements ListSorter
{
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
        for ($slot = 0; $slot < $list->size() - 1; $slot++) {
            $smallest = $slot;

            for ($check = $slot + 1; $check < $list->size(); $check++) {
                $smallest = $this->getSmallestIndex($list, $check, $smallest);
            }

            $this->swap($list, $smallest, $slot);
        }

        return $list;
    }

    /**
     * @param Jmweb\Algorithm\IList $list 
     * @param int $check 
     * @param int $smallest 
     * @return void
     */
    protected function getSmallestIndex(IList $list, $check, $smallest)
    {
        if ($this->_comparator->compare($list->get($check), 
                                        $list->get($smallest)) < 0) {
            $smallest = $check;
        }

        return $smallest;
    }

    /**
     * @param Jmweb\Algorithm\IList $list 
     * @param int $left 
     * @param int $right 
     * @return void
     */
    protected function swap(IList $list, $left, $right)
    {
        if ($left == $right)
            return false;

        $leftValue = $list->get($left);
        $list->set($left, $list->get($right));
        $list->set($right, $leftValue);
    }
}
