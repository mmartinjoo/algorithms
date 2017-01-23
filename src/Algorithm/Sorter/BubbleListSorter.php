<?php

namespace Jmweb\Algorithm\Sorter;

use Jmweb\Algorithm\IList;
use Jmweb\Algorithm\Sorter\ListSorter;
use Jmweb\Algorithm\Comparator\Comparator;

class BubbleListSorter implements ListSorter
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
        for ($pass = 1; $pass < $list->size(); $pass++) {
            for ($left = 0; $left < ($list->size() - $pass); $left++) {
                $right = $left + 1;
                $this->swapIfLeftIsGreater($list, $left, $right);
            }
        } 

        return $list;
    }

    /**
     * @param Jmweb\Algorithm\IList $list 
     * @param int $left 
     * @param int $right 
     * @return void
     */
    protected function swapIfLeftIsGreater(IList &$list, $left, $right)
    {
        if ($this->_comparator->compare($list->get($left), $list->get($right)) > 0) {
            $this->swap($list, $left, $right);
        }
    }

    /**
     * @param Jmweb\Algorithm\IList $list 
     * @param int $left 
     * @param int $right 
     * @return void
     */
    protected function swap(IList &$list, $left, $right)
    {
        $leftObject = $list->get($left);
        $list->set($left, $list->get($right));
        $list->set($right, $leftObject);
    }
}
