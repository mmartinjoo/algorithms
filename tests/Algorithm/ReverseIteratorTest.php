<?php

namespace Jmweb\Tests\Algorithm;

use PHPUnit\Framework\TestCase;
use Jmweb\Algorithm\ArrayIterator;
use Jmweb\Algorithm\ReverseIterator;
use Jmweb\Exception\IteratorOutOfBoundsException;

class ReverseIteratorTest extends TestCase
{
    private static $_array = ['A', 'B', 'C'];

    /**
     * @covers ReverseIterator::first();
     * @covers ReverseIterator::isDone();
     * @covers ReverseIterator::current();
     * @covers ReverseIterator::next();
     */
    public function testIterationBackwards()
    {
        $iterator = new ReverseIterator(new ArrayIterator(self::$_array));

        $iterator->first();
        $this->assertFalse($iterator->isDone());
        $this->assertEquals(self::$_array[2], $iterator->current());

        $iterator->next();
        $this->assertFalse($iterator->isDone());
        $this->assertEquals(self::$_array[1], $iterator->current());

        $iterator->next();
        $this->assertFalse($iterator->isDone());
        $this->assertEquals(self::$_array[0], $iterator->current());

        $iterator->next();
        $this->assertTrue($iterator->isDone());

        try {
            $iterator->current();
            $this->fail();    
        } catch (IteratorOutOfBoundsException $ex) {
            $this->assertTrue(true);
        }
    }

    /**
     * @covers ReverseIterator::last();
     * @covers ReverseIterator::isDone();
     * @covers ReverseIterator::current();
     * @covers ReverseIterator::previous();
     */
    public function testIterationForward()
    {
        $iterator = new ReverseIterator(new ArrayIterator(self::$_array));

        $iterator->last();
        $this->assertFalse($iterator->isDone());
        $this->assertEquals(self::$_array[0], $iterator->current());

        $iterator->previous();
        $this->assertFalse($iterator->isDone());
        $this->assertEquals(self::$_array[1], $iterator->current());

        $iterator->previous();
        $this->assertFalse($iterator->isDone());
        $this->assertEquals(self::$_array[2], $iterator->current());

        $iterator->previous();
        $this->assertTrue($iterator->isDone());

        try {
            $iterator->current();
            $this->fail();    
        } catch (IteratorOutOfBoundsException $ex) {
            $this->assertTrue(true);
        }
    }
}
