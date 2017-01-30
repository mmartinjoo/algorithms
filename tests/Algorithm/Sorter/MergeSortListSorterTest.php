<?php

namespace Jmweb\Tests\Algorithm\Sorter;

use PHPUnit\Framework\TestCase;
use Jmweb\Tests\Algorithm\Sorter\AbstractListSorterTestCase;
use Jmweb\Algorithm\Comparator\Comparator;
use Jmweb\Algorithm\Sorter\MergeSortListSorter;

class MergeSortListSorterTest extends AbstractListSorterTestCase
{
    /**
     * @param Jmweb\Algorithm\Comparator\Comparator $comparator 
     * @return Jmweb\Algorithm\Sorter\MergeSortListSorter
     */
    protected function createListSorter(Comparator $comparator)
    {
        return new MergeSortListSorter($comparator);
    }
}
