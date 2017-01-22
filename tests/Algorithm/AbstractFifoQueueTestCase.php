<?php

namespace Jmweb\Tests\Algorithm;

use PHPUnit\Framework\TestCase;
use Jmweb\Exception\EmptyQueueException;

abstract class AbstractFifoQueueTestCase extends TestCase
{
    const VALUE_A = 'A';
    const VALUE_B = 'B';
    const VALUE_C = 'C';

    protected $_queue;

    /**
     * @return Queue
     */
    abstract protected function createFifoQueue();

    protected function setUp()
    {
        $this->_queue = $this->createFifoQueue();
    }

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
        $this->_queue->enqueue(self::VALUE_A);
        $this->_queue->enqueue(self::VALUE_C);

        $this->assertEquals(3, $this->_queue->size());
        $this->assertFalse($this->_queue->isEmpty());

        $this->assertEquals(self::VALUE_B, $this->_queue->dequeue());
        $this->assertEquals(2, $this->_queue->size());
        $this->assertFalse($this->_queue->isEmpty());

        $this->assertEquals(self::VALUE_A, $this->_queue->dequeue());
        $this->assertEquals(1, $this->_queue->size());
        $this->assertFalse($this->_queue->isEmpty());

        $this->assertEquals(self::VALUE_C, $this->_queue->dequeue());
        $this->assertEquals(0, $this->_queue->size());
        $this->assertTrue($this->_queue->isEmpty());

        try {
            $this->_queue->dequeue();
            $this->fail();
        } catch (EmptyQueueException $ex) {
            $this->assertTrue(true);
        }
    }

    public function testClear()
    {
        $this->_queue->enqueue(self::VALUE_A);
        $this->_queue->enqueue(self::VALUE_B);
        $this->_queue->enqueue(self::VALUE_C);

        $this->assertFalse($this->_queue->isEmpty());

        $this->_queue->clear();
        $this->assertTrue($this->_queue->isEmpty());
        $this->assertEquals(0, $this->_queue->size());

        try {
            $this->_queue->dequeue();
            $this->fail();
        } catch (EmptyQueueException $ex) {
            $this->assertTrue(true);
        }
    }
}
