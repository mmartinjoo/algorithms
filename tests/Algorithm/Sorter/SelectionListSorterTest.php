<?php

namespace Jmweb\Tests\Algorithm\Sorter;

use PHPUnit\Framework\TestCase;
use Jmweb\Tests\Algorithm\Sorter\AbstractListSorterTestCase;
use Jmweb\Algorithm\Comparator\Comparator;
use Jmweb\Algorithm\Sorter\SelectionListSorter;

class SelectionListSorterTest extends AbstractListSorterTestCase
{
    /**
     * @param Jmweb\Algorithm\Comparator\Comparator $comparator 
     * @return Jmweb\Algorithm\Sorter\SelectionListSorter
     */
    protected function createListSorter(Comparator $comparator)
    {
        return new SelectionListSorter($comparator);
    }
}

