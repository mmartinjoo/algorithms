<?php

namespace Jmweb\Tests\Algorithm\Searcher;

use PHPUnit\Framework\TestCase;
use Jmweb\Algorithm\Searcher\ListSearcher;
use Jmweb\Algorithm\LinkedList;
use Jmweb\Algorithm\IList;
use Jmweb\Algorithm\ArrayList;
use Jmweb\Algorithm\Comparator\Comparator;
use Jmweb\Algorithm\Comparator\NaturalComparator;

abstract class AbstractListSearcherTestCase extends TestCase
{
    const VALUES = ['B', 'C', 'D', 'F', 'H', 'I', 'J', 'K', 'L', 'M', 'P', 'Q'];

    /**
     * @var Jmweb\Algorithm\Searcher\ListSearcher
     */
    protected $_searcher;

    /**
     * @var Jmweb\Algorithm\IList
     */
    protected $_list;

    /**
     * @param Jmweb\Algorithm\Comparator\Comparator $comparator
     * @return Jmweb\Algorithm\Searcher\ListSearcher
     */
    abstract protected function createSearcher(Comparator $comparator); 

    protected function setUp()
    {
        $this->_searcher = $this->createSearcher(NaturalComparator::instance());
        $this->_list = new ArrayList;

        foreach (self::VALUES as $value) {
            $this->_list->add($value);
        }
    }

    public function testSearchForExistingValues()
    {
        for ($i = 0; $i < $this->_list->size(); $i++) {
            $this->assertEquals($i, $this->_searcher->search($this->_list, $this->_list->get($i)));
        }
    }

    public function testSearchForNonExistingValueLessThanFirstItem()
    {
        $this->assertEquals(-1, $this->_searcher->search($this->_list, 'A'));
    }

    public function testSearchForNonExistingValueGreaterThanLastItem()
    {
        $this->assertEquals(-13, $this->_searcher->search($this->_list, 'Z'));
    }

    public function testSearchForArbitraryNonExistingValue()
    {
        $this->assertEquals(-4, $this->_searcher->search($this->_list, 'E'));
    }
}
