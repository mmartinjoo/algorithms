<?php

namespace Jmweb\Tests\Algorithm;

use PHPUnit\Framework\TestCase;
use Jmweb\Algorithm\Queue;
use Jmweb\Algorithm\Comparator\NaturalComparator;
use Jmweb\Algorithm\Comparator\Comparator;
use Jmweb\Algorithm\HeapOrderedListPriorityQueue;

class HeapOrderedListPriorityQueueTest extends AbstractPriorityQueueTestCase
{
    /**
     * @param Jmweb\Algorithm\Comparator\Comparator
     * @return Jmweb\Algorithm\Queue
     */
    protected function createQueue(Comparator $comparator)
    {
        return new HeapOrderedListPriorityQueue($comparator);
    }
}
