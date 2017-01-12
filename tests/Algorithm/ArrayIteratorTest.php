<?php

namespace Jmweb\Tests\Algorithm;

use PHPUnit\Framework\TestCase;
use Jmweb\Algorithm\ArrayIterator;
use Jmweb\Exception\IteratorOutOfBoundsException;

class ArrayIteratorTest extends TestCase 
{
    /**
     * @covers ArrayIterator::__construct()
     * @covers ArrayIterator::getArray()
     * @covers ArrayIterator::getStart()
     * @covers ArrayIterator::getEnd()
     */
    public function testConstructWithFullArray()
    {
        $array = [1, 2, 3];
        $iterator = new ArrayIterator($array);

        $this->assertEquals($array, $iterator->getArray());
        $this->assertEquals(0, $iterator->getStart());
        $this->assertEquals(count($array) - 1, $iterator->getEnd());
    }

    /**
     * @covers ArrayIterator::__construct()
     * @covers ArrayIterator::getArray()
     * @covers ArrayIterator::getStart()
     * @covers ArrayIterator::getEnd()
     */
    public function testConstructWithSubArray()
    {
        $array = [1, 2, 3, 4, 5];
        $iterator = new ArrayIterator($array, 1, 2);

        $this->assertEquals($array, $iterator->getArray());
        $this->assertEquals(1, $iterator->getStart());
        $this->assertEquals(2, $iterator->getEnd());
    }

    /**
     * @covers ArrayIterator::first()
     * @covers ArrayIterator::isDone()
     * @covers ArrayIterator::current()
     * @covers ArrayIterator::next()
     */
    public function testIteration()
    {
        $array = ['A', 'B', 'C', 'D'];
        $iterator = new ArrayIterator($array, 1, 3);

        $iterator->first();
        $this->assertFalse($iterator->isDone());
        $this->assertEquals($array[1], $iterator->current());

        $iterator->next();
        $this->assertFalse($iterator->isDone());
        $this->assertEquals($array[2], $iterator->current());

        $iterator->next();
        $this->assertFalse($iterator->isDone());
        $this->assertEquals($array[3], $iterator->current());

        $iterator->next();
        $this->assertTrue($iterator->isDone());

        try {
            $iterator->current();
            $this->fail();
        } catch (IteratorOutOfBoundsException $ex) {
            $this->assertTrue(true);
        }
    }
}
