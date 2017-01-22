<?php

namespace Jmweb\Tests\Algorithm;

use PHPUnit\Framework\TestCase;
use Jmweb\Exception\EmptyStackException;

abstract class AbstractStackTestCase extends TestCase
{
    const VALUE_A = 'A';
    const VALUE_B = 'B';
    const VALUE_C = 'C';

    /**
     * @return Stack  
     */
    abstract protected function createStack();

    public function testPushAndPop()
    {
        $stack = $this->createStack();

        $stack->push(self::VALUE_B);
        $stack->push(self::VALUE_A);
        $stack->push(self::VALUE_C);

        $this->assertEquals(3, $stack->size());
        $this->assertFalse($stack->isEmpty());

        $this->assertEquals(self::VALUE_C, $stack->pop());
        $this->assertEquals(2, $stack->size());
        $this->assertFalse($stack->isEmpty());
        
        $this->assertEquals(self::VALUE_A, $stack->pop());
        $this->assertEquals(1, $stack->size());
        $this->assertFalse($stack->isEmpty());

        $this->assertEquals(self::VALUE_B, $stack->pop());
        $this->assertEquals(0, $stack->size());
        $this->assertTrue($stack->isEmpty());
    }

    public function testCannotPopFromEmptyStack()
    {
        $stack = $this->createStack();

        $this->assertEquals(0, $stack->size());
        $this->assertTrue($stack->isEmpty());

        try {
            $stack->pop();
            $this->fail();
        } catch (EmptyStackException $ex) {
            $this->assertTrue(true);
        }
    }

    public function testPeek()
    {
        $stack = $this->createStack();

        $stack->push(self::VALUE_C);
        $stack->push(self::VALUE_A);

        $this->assertEquals(2, $stack->size());
        $this->assertFalse($stack->isEmpty());

        $this->assertEquals(self::VALUE_A, $stack->peek());
        $this->assertEquals(2, $stack->size());
        $this->assertFalse($stack->isEmpty());
    }

    public function testCannotPeekFromEmptyStack()
    {
        $stack = $this->createStack();
        $this->assertEquals(0, $stack->size());
        $this->assertTrue($stack->isEmpty());

        try {
            $stack->peek();
            $this->fail();
        } catch (EmptyStackException $ex) {
            $this->assertTrue(true);
        }
    }

    public function testClear()
    {
        $stack = $this->createStack();

        $stack->push(self::VALUE_A);
        $stack->push(self::VALUE_B);
        $stack->push(self::VALUE_C);

        $this->assertFalse($stack->isEmpty());
        $this->assertEquals(3, $stack->size());

        $stack->clear();

        try {
            $stack->pop();
            $this->fail();
        } catch (EmptyStackException $ex) {
            $this->assertTrue(true);
        }
    }
}
