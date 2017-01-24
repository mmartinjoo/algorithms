<?php

namespace Jmweb\Algorithm\Sorter;

use Jmweb\Algorithm\IList;
use Jmweb\Algorithm\Sorter\ListSorter;
use Jmweb\Algorithm\Comparator\Comparator;
use Jmweb\Algorithm\LinkedList;

class InsertionListSorter implements ListSorter
{
    protected $_comparator;
    
    public function __construct($_comparator)
    {
        $this->_comparator = $_comparator;
    }

    public function sort(IList $list)
    {
        $result = new LinkedList;
        $iterator = $list->iterator();

        for ($iterator->first(); !$iterator->isDone(); $iterator->next()) {
            $slot = $result->size();

            while ($slot > 0) {
                if ($this->_comparator->compare($iterator->current(), 
                                                $result->get($slot - 1)) >= 0) {
                    break;
                }

                $slot--;
            }

            $result->insert($slot, $iterator->current());
        }

        return $result;
    }
}
