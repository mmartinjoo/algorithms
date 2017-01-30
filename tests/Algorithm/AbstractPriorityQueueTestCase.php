<?php

namespace Jmweb\Tests\Algorithm;

use PHPUnit\Framework\TestCase;
use Jmweb\Exception\IndexOutOfBoundsException;
use Jmweb\Exception\IteratorOutOfBoundsException;
use Jmweb\Algorithm\Queue;
use Jmweb\Algorithm\Comparator\NaturalComparator;
use Jmweb\Algorithm\Comparator\Comparator;
use Jmweb\Exception\EmptyQueueException;

abstract class AbstractPriorityQueueTestCase extends TestCase
{
    const VALUE_A = 'A';
    const VALUE_B = 'B';
    const VALUE_C = 'C';
    const VALUE_D = 'D';
    const VALUE_E = 'E';

    /**
     * @var Jmweb\Algorithm\Queue
     */
    protected $_queue;

    protected function setUp()
    {
        $this->_queue = $this->createQueue(NaturalComparator::instance());
    }

    protected function tearDown()
    {
        $this->_queue = null;
    }

    /**
     * @param Jmweb\Algorithm\Comparator\Comparator
     * @return Jmweb\Algorithm\Queue  
     */
    abstract protected function createQueue(Comparator $comparator);

    public function testAccessEmptyQueue()
    {
        $this->assertEquals(0, $this->_queue->size());
        $this->assertTrue($this->_queue->isEmpty());

        try {
            $this->_queue->dequeue();
            $this->fail();
        } catch (EmptyQueueException $ex) {
            $this->assertTrue(true);
        }
    }

    public function testEnqueueDequeue()
    {
        $this->_queue->enqueue(self::VALUE_B);
        $this->_queue->enqueue(self::VALUE_D);
        $this->_queue->enqueue(self::VALUE_A);

        $this->assertEquals(3, $this->_queue->size());
        $this->assertFalse($this->_queue->isEmpty());

        $this->assertEquals(self::VALUE_D, $this->_queue->dequeue());
        $this->assertEquals(2, $this->_queue->size());
        $this->assertFalse($this->_queue->isEmpty());

        $this->assertEquals(self::VALUE_B, $this->_queue->dequeue());
        $this->assertEquals(1, $this->_queue->size());
        $this->assertFalse($this->_queue->isEmpty());

        $this->_queue->enqueue(self::VALUE_E);
        $this->_queue->enqueue(self::VALUE_C);

        $this->assertEquals(3, $this->_queue->size());
        $this->assertFalse($this->_queue->isEmpty());

        $this->assertEquals(self::VALUE_E, $this->_queue->dequeue());
        $this->assertEquals(2, $this->_queue->size());
        $this->assertFalse($this->_queue->isEmpty());

        $this->assertEquals(self::VALUE_C, $this->_queue->dequeue());
        $this->assertEquals(1, $this->_queue->size());
        $this->assertFalse($this->_queue->isEmpty());

        $this->assertEquals(self::VALUE_A, $this->_queue->dequeue());
        $this->assertEquals(0, $this->_queue->size());
        $this->assertTrue($this->_queue->isEmpty());
    }

    public function testClear()
    {
        $this->_queue->enqueue(self::VALUE_A);
        $this->_queue->enqueue(self::VALUE_B);
        $this->_queue->enqueue(self::VALUE_C);
        $this->assertFalse($this->_queue->isEmpty());

        $this->_queue->clear();
        $this->assertTrue($this->_queue->isEmpty());
    }
}
