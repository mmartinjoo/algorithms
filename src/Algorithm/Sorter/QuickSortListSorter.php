<?php

namespace Jmweb\Algorithm\Sorter;

use Jmweb\Algorithm\IList;
use Jmweb\Algorithm\Sorter\ListSorter;
use Jmweb\Algorithm\Comparator\Comparator;

class QuickSortListSorter implements ListSorter
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
        $this->quicksort($list, 0, $list->size() - 1);
        return $list;
    }

    protected function quicksort(IList $list, $leftIndex, $rightIndex)
    {
        if ($leftIndex < 0 || $rightIndex >= $list->size()) {
            return;
        }

        if ($rightIndex <= $leftIndex) {
            return;
        }

        /**
         * @todo legyen a kozepso elem
         * ne legyen lekerdezve itt, hanem a partition -ben
         * $rightIndex - 1 helyett, csak $rightIndex legyen
         * pivotIndex = left + (right - left) / 2
         */
        $pivot = $list->get($rightIndex);
        $partition = $this->partition($list, $pivot, $leftIndex, $rightIndex - 1);

        if ($this->_comparator->compare($list->get($partition), $pivot) < 0) {
            $partition++;
        }

        $this->swap($list, $partition, $rightIndex);
        $this->quicksort($list, $leftIndex, $partition - 1);
        $this->quicksort($list, $partition + 1, $rightIndex);
    }

    /**
     * @param Jmweb\Algorithm\IList $list 
     * @param mixed $pivotValue 
     * @param int $leftIndex 
     * @param int $rightIndex 
     * @return int
     */
    protected function partition(IList $list, $pivotValue, $leftIndex, $rightIndex)
    {
        $left = $leftIndex;
        $right = $rightIndex;

        while ($left < $right) {
            /**
             * @todo continue helyett legyen ket while ciklus
             */
            if ($this->_comparator->compare($list->get($left), $pivotValue) < 0) {
                $left++;
                continue;
            }

            if ($this->_comparator->compare($list->get($right), $pivotValue) >= 0) {
                $right--;
                continue;
            }

            $this->swap($list, $left, $right);
            $left++;
        }

        return $left;
    }

    protected function swap(IList $list, $leftIndex, $rightIndex)
    {
        if ($leftIndex == $rightIndex) 
            return;

        $tmp = $list->get($leftIndex);
        $list->set($leftIndex, $list->get($rightIndex));
        $list->set($rightIndex, $tmp);
    }
}
