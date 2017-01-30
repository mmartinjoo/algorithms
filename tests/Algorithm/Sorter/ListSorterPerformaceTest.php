<?php

namespace Jmweb\Tests\Algorithm;

use PHPUnit\Framework\TestCase;
use Jmweb\Algorithm\Comparator\CallCountingComparator;
use Jmweb\Algorithm\Comparator\NaturalComparator;
use Jmweb\Algorithm\Sorter\BubbleListSorter;
use Jmweb\Algorithm\Sorter\SelectionListSorter;
use Jmweb\Algorithm\Sorter\InsertionListSorter;
use Jmweb\Algorithm\Sorter\QuickSortListSorter;
use Jmweb\Algorithm\Sorter\MergeSortListSorter;
use Jmweb\Algorithm\InsertCountingLinkedList;

class ListSorterPerformaceTest extends TestCase
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
        $this->_sortedList = new InsertCountingLinkedList();
        $this->_reverseList = new InsertCountingLinkedList();
        $this->_randomList = new InsertCountingLinkedList();

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

        $this->_sortedList->setInsertCount(0);
        $this->_reverseList->setInsertCount(0);
        $this->_randomList->setInsertCount(0);

        $this->_startTime = microtime();
        $this->_startMemoryUsage = memory_get_usage();
    }

    public function testWorstCaseBubbleSort()
    {
        $sorter = new BubbleListSorter($this->_comparator);
        $sorter->sort($this->_reverseList);
        $this->reportPerformance($this->_comparator->getCount());
    }

    public function testWorstCaseSelectionSort()
    {
        $sorter = new SelectionListSorter($this->_comparator);
        $sorter->sort($this->_reverseList);
        $this->reportPerformance($this->_comparator->getCount());
    }

    public function testWorstCaseInsertionSort()
    {
        $sorter = new InsertionListSorter($this->_comparator);
        $sorter->sort($this->_reverseList);
        $this->reportPerformance($this->_comparator->getCount());
    }

    public function testWorstCaseQuickSort()
    {
        $sorter = new QuickSortListSorter($this->_comparator);
        $sorter->sort($this->_reverseList);
        $this->reportPerformance($this->_comparator->getCount());
    }

    public function testWorstCaseMergeSort()
    {
        $sorter = new MergeSortListSorter($this->_comparator);
        $sorter->sort($this->_reverseList);
        $this->reportPerformance($this->_comparator->getCount());
    }

    public function testBestCaseBubbleSort()
    {
        $sorter = new BubbleListSorter($this->_comparator);
        $sorter->sort($this->_sortedList);
        $this->reportPerformance($this->_comparator->getCount());
    }

    public function testBestCaseSelectionSort()
    {
        $sorter = new SelectionListSorter($this->_comparator);
        $sorter->sort($this->_sortedList);
        $this->reportPerformance($this->_comparator->getCount());
    }

    public function testBestCaseInsertionSort()
    {
        $sorter = new InsertionListSorter($this->_comparator);
        $sorter->sort($this->_sortedList);
        $this->reportPerformance($this->_comparator->getCount());
    }

    public function testBestCaseQuickSort()
    {
        $sorter = new QuickSortListSorter($this->_comparator);
        $sorter->sort($this->_sortedList);
        $this->reportPerformance($this->_comparator->getCount());
    }

    /* public function testBestCaseMergeSort() */
    /* { */
    /*     $sorter = new MergeSortListSorter($this->_comparator); */
    /*     $sorter->sort($this->_sortedList); */
    /*     $this->reportPerformance($this->_comparator->getCount()); */
    /* } */

    public function testAvarageCaseBubbleSort()
    {
        $sorter = new BubbleListSorter($this->_comparator);
        $sorter->sort($this->_randomList);
        $this->reportPerformance($this->_comparator->getCount());
    }

    public function testAvarageCaseSelectionSort()
    {
        $sorter = new SelectionListSorter($this->_comparator);
        $sorter->sort($this->_randomList);
        $this->reportPerformance($this->_comparator->getCount());
    }

    public function testAvarageCaseInsertionSort()
    {
        $sorter = new InsertionListSorter($this->_comparator);
        $sorter->sort($this->_randomList);
        $this->reportPerformance($this->_comparator->getCount());
    }

    public function testAvarageCaseQuickSort()
    {
        $sorter = new QuickSortListSorter($this->_comparator);
        $sorter->sort($this->_randomList);
        $this->reportPerformance($this->_comparator->getCount());
    }

    public function testAvarageCaseMergeSort()
    {
        $sorter = new MergeSortListSorter($this->_comparator);
        $sorter->sort($this->_randomList);
        $this->reportPerformance($this->_comparator->getCount());
    }

    /**
     * @param int $callCount 
     * @return void
     */
    protected function reportPerformance($callCount)
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

        $list = $this->getListByTestName();

        echo "\r\n";
        echo $this->getName() . " inserts: " . $list->getInsertCount() . "\r\n";
        echo $this->getName() . " comparasions: " . $callCount . "\r\n";
        echo $this->getName() . " runtime: " . $millisec  . " ms, " . $sec . " s \r\n";
        echo $this->getName() . " memory: " . $memoryUsage . " bytes, " . $memoryUsageMegaBytes . " MB \r\n";
    }

    protected function getListByTestName()
    {
        if (strpos($this->getName(), 'Worst') !== false) {
            return $this->_reverseList;
        }

        if (strpos($this->getName(), 'Best') !== false) {
            return $this->_sortedList;
        }

        return $this->_randomList;
    }
}
