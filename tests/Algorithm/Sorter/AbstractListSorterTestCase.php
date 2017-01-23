<?php

namespace Jmweb\Tests\Algorithm\Sorter;

use PHPUnit\Framework\TestCase;
use Jmweb\Algorithm\Comparator\NaturalComparator;
use Jmweb\Algorithm\Comparator\Comparator;
use Jmweb\Algorithm\LinkedList;

abstract class AbstractListSorterTestCase extends TestCase
{
    /**
     * @var Jmweb\Algorithm\IList
     */
    protected $_sortedList;

    /**
     * @var Jmweb\Algorithm\IList
     */
    protected $_unsortedList;

    /**
     * @param Jmweb\Algorithm\Comparator\Comparator $comparator 
     * @return Jmweb\Algorithm\Sorter\ListSorter
     */
    abstract protected function createListSorter(Comparator $comparator);

    protected function setUp()
    {
        $this->_unsortedList = new LinkedList;

        $this->_unsortedList->add('test');
        $this->_unsortedList->add('driven');
        $this->_unsortedList->add('development');
        $this->_unsortedList->add('is');
        $this->_unsortedList->add('one');
        $this->_unsortedList->add('small');
        $this->_unsortedList->add('step');
        $this->_unsortedList->add('for');
        $this->_unsortedList->add('a');
        $this->_unsortedList->add('programmer');
        $this->_unsortedList->add('but');
        $this->_unsortedList->add('it\'s');
        $this->_unsortedList->add('one');
        $this->_unsortedList->add('giant');
        $this->_unsortedList->add('leap');
        $this->_unsortedList->add('for');
        $this->_unsortedList->add('programming');

        $this->_sortedList = new LinkedList;

        $this->_sortedList->add('a');
        $this->_sortedList->add('but');
        $this->_sortedList->add('development');
        $this->_sortedList->add('driven');
        $this->_sortedList->add('for');
        $this->_sortedList->add('for');
        $this->_sortedList->add('giant');
        $this->_sortedList->add('is');
        $this->_sortedList->add('it\'s');
        $this->_sortedList->add('leap');
        $this->_sortedList->add('one');
        $this->_sortedList->add('one');
        $this->_sortedList->add('programmer');
        $this->_sortedList->add('programming');
        $this->_sortedList->add('small');
        $this->_sortedList->add('step');
        $this->_sortedList->add('test');
    }

    protected function tearDown()
    {
        $this->_sortedList = null;
        $this->_unsortedList = null;
    }

    public function testListSorterCanSortSampleList()
    {
        $listSorter = $this->createListSorter(NaturalComparator::instance());
        $result = $listSorter->sort($this->_unsortedList);

        $this->assertEquals($result->size(), $this->_sortedList->size());

        $actual = $result->iterator();
        $expected = $this->_sortedList->iterator();

        $actual->first();
        $expected->first();

        while (!$expected->isDone()) {
            $this->assertEquals($expected->current(), $actual->current());
            $expected->next();
            $actual->next();
        }
    }
}
