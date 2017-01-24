<?php

namespace Jmweb\Tests\Algorithm;

use PHPUnit\Framework\TestCase;
use Jmweb\Algorithm\Comparator\CallCountingComparator;
use Jmweb\Algorithm\Comparator\NaturalComparator;
use Jmweb\Algorithm\Sorter\BubbleListSorter;
use Jmweb\Algorithm\Sorter\SelectionListSorter;
use Jmweb\Algorithm\Sorter\InsertionListSorter;
use Jmweb\Algorithm\LinkedList;

class ListSorterCallCountingTest extends TestCase
{
    const TEST_SIZE = 100;

    private $_sortedList;
    private $_reverseList;
    private $_randomList;

    private $_comparator;

    private $_startTime;
    private $_endTime;

    private $_startMemoryUsage;
    private $_endMemoryUsage;

    protected function setUp()
    {
        $this->_sortedList = new LinkedList();
        $this->_reverseList = new LinkedList();
        $this->_randomList = new LinkedList();

        $this->_comparator = new CallCountingComparator(NaturalComparator::instance());

        for ($i = 0; $i < self::TEST_SIZE; $i++) {
            $this->_sortedList->add($i);
        }

        for ($i = self::TEST_SIZE; $i > 0; $i--) {
            $this->_reverseList->add($i);
        }

        for ($i = 0; $i < self::TEST_SIZE; $i++) {
            $this->_randomList->add(rand(0, self::TEST_SIZE));
        }

        $this->_startTime = microtime();
        $this->_startMemoryUsage = memory_get_usage();
    }

    public function testWorstCaseBubbleSort()
    {
        $sorter = new BubbleListSorter($this->_comparator);
        $sorter->sort($this->_reverseList);
        $this->reportCalls($this->_comparator->getCount());
    }

    public function testWorstCaseSelectionSort()
    {
        $sorter = new SelectionListSorter($this->_comparator);
        $sorter->sort($this->_reverseList);
        $this->reportCalls($this->_comparator->getCount());
    }

    public function testWorstCaseInsertionSort()
    {
        $sorter = new InsertionListSorter($this->_comparator);
        $sorter->sort($this->_reverseList);
        $this->reportCalls($this->_comparator->getCount());
    }

    public function testBestCaseBubbleSort()
    {
        $sorter = new BubbleListSorter($this->_comparator);
        $sorter->sort($this->_sortedList);
        $this->reportCalls($this->_comparator->getCount());
    }

    public function testBestCaseSelectionSort()
    {
        $sorter = new SelectionListSorter($this->_comparator);
        $sorter->sort($this->_sortedList);
        $this->reportCalls($this->_comparator->getCount());
    }

    public function testBestCaseInsertionSort()
    {
        $sorter = new InsertionListSorter($this->_comparator);
        $sorter->sort($this->_sortedList);
        $this->reportCalls($this->_comparator->getCount());
    }

    public function testAvarageCaseBubbleSort()
    {
        $sorter = new BubbleListSorter($this->_comparator);
        $sorter->sort($this->_sortedList);
        $this->reportCalls($this->_comparator->getCount());
    }

    public function testAvarageCaseSelectionSort()
    {
        $sorter = new SelectionListSorter($this->_comparator);
        $sorter->sort($this->_sortedList);
        $this->reportCalls($this->_comparator->getCount());
    }

    public function testAvarageCaseInsertionSort()
    {
        $sorter = new InsertionListSorter($this->_comparator);
        $sorter->sort($this->_sortedList);
        $this->reportCalls($this->_comparator->getCount());
    }

    /**
     * @param int $callCount 
     * @return void
     */
    protected function reportCalls($callCount)
    {
        $this->_endTime = microtime();
        $this->_endMemoryUsage = memory_get_usage();

        $memoryUsage = $this->_endMemoryUsage - $this->_startMemoryUsage;
        $memoryUsageMegaBytes = $memoryUsage / 1024;

        list($startUsec, $startSec) = explode(' ', $this->_startTime);
        list($endUsec, $endSec) = explode(' ', $this->_endTime);

        $startTime = (float)$startUsec + (float)$startSec;
        $endTime = (float)$endUsec + (float)$endSec;

        $sec = $endTime - $startTime;
        $millisec = $sec * 1000;

        echo "\r\n";
        echo $this->getName() . " comparasions: " . $callCount . "\r\n";
        echo $this->getName() . " runtime: " . $millisec  . " ms, " . $sec . " s \r\n";
        echo $this->getName() . " memory: " . $memoryUsage . " bytes, " . $memoryUsageMegaBytes . " MB \r\n";
    }
}
