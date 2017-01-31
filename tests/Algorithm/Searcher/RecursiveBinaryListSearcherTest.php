<?php

namespace Jmweb\Tests\Algorithm\Searcher;

use Jmweb\Tests\Algorithm\Searcher\AbstractListSearcherTestCase;
use Jmweb\Algorithm\Searcher\ListSearcher;
use Jmweb\Algorithm\Searcher\RecursiveBinaryListSearcher;
use Jmweb\Algorithm\Comparator\Comparator;

class RecursiveBinaryListSearcherTest extends AbstractListSearcherTestCase
{
    /**
     * @param Jmweb\Algorithm\Comparator\Comparator $comparator 
     * @return Jmweb\Algorithm\Searcher\ListSearcher
     */
    protected function createSearcher(Comparator $comparator)
    {
        return new RecursiveBinaryListSearcher($comparator);
    }
}
