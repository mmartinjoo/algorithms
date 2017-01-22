<?php

namespace Jmweb\Tests\Algorithm;

use PHPUnit\Framework\TestCase;
use Jmweb\Exception\IndexOutOfBoundsException;
use Jmweb\Exception\IteratorOutOfBoundsException;

abstract class AbstractListTestCase extends TestCase
{
    const VALUE_A = 'A';
    const VALUE_B = 'B';
    const VALUE_C = 'C';

    /**
     * @return Jmweb\Algorithm\List
     */
    protected abstract function createList();

    public function testInsertIntoEmptyList()
    {
        $list = $this->createList();

        $this->assertEquals(0, $list->size());
        $this->assertTrue($list->isEmpty());

        $list->insert(0, self::VALUE_A);
        $this->assertEquals(1, $list->size());
        $this->assertFalse($list->isEmpty());
        $this->assertEquals(self::VALUE_A, $list->get(0));
    }

    public function testInsertBetweenElements()
    {
        $list = $this->createList();

        $list->insert(0, self::VALUE_A);
        $list->insert(1, self::VALUE_B);
        $list->insert(2, self::VALUE_C);

        $this->assertEquals(3, $list->size());

        $this->assertEquals(self::VALUE_A, $list->get(0));
        $this->assertEquals(self::VALUE_B, $list->get(1));
        $this->assertEquals(self::VALUE_C, $list->get(2));
    }

    public function testInsertBeforeFirstElement()
    {
        $list = $this->createList();

        $list->insert(0, self::VALUE_A);
        $list->insert(1, self::VALUE_B);

        $this->assertEquals(2, $list->size());
        $this->assertEquals(self::VALUE_A, $list->get(0));
        $this->assertEquals(self::VALUE_B, $list->get(1));
    }

    public function testInsertAfterLastElement()
    {
        $list = $this->createList();

        $list->insert(0, self::VALUE_A);
        $list->insert(1, self::VALUE_B);

        $this->assertEquals(2, $list->size());
        $this->assertEquals(self::VALUE_A, $list->get(0));
        $this->assertEquals(self::VALUE_B, $list->get(1));
    }

    public function testInsertOutOfBounds()
    {
        $list = $this->createList();

        try {
            $list->insert(-1, self::VALUE_A);
            $this->fail();
        } catch (IndexOutOfBoundsException $ex) {
            $this->assertTrue(true);
        }

        /* try { */
        /*     $list->insert(1, self::VALUE_B); */
        /*     $this->fail(); */
        /* } catch (IndexOutOfBoundsException $ex) { */
        /*     $this->assertTrue(true); */
        /* } */
    }

    public function testAdd()
    {
        $list = $this->createList();

        $list->add(self::VALUE_A);
        $list->add(self::VALUE_C);
        $list->add(self::VALUE_B);

        $this->assertEquals(3, $list->size());
        $this->assertEquals(self::VALUE_A, $list->get(0));
        $this->assertEquals(self::VALUE_C, $list->get(1));
        $this->assertEquals(self::VALUE_B, $list->get(2));
    }

    public function testSet()
    {
        $list = $this->createList();

        $list->insert(0, self::VALUE_A);
        $this->assertEquals(self::VALUE_A, $list->get(0));

        $this->assertEquals(self::VALUE_A, $list->set(0, self::VALUE_B));
        $this->assertEquals(self::VALUE_B, $list->get(0));
    }

    public function testGetOutOfBounds()
    {
        $list = $this->createList();

        try {
            $list->get(-1);
            $this->fail();
        } catch (IndexOutOfBoundsException $ex) {
            $this->assertTrue(true);
        }

        try {
            $list->get(0);
            $this->fail();
        } catch (IndexOutOfBoundsException $ex) {
            $this->assertTrue(true);
        }

        $list->add(self::VALUE_A);
        try {
            $list->get(1);
            $this->fail();
        } catch (IndexOutOfBoundsException $ex) {
            $this->assertTrue(true);
        }
    }

    public function testSetOutOfBounds()
    {
        $list = $this->createList();

        try {
            $list->set(-1, self::VALUE_A);
            $this->fail();
        } catch (IndexOutOfBoundsException $ex) {
            $this->assertTrue(true);
        }

        try {
            $list->set(0, self::VALUE_B);
            $this->fail();
        } catch (IndexOutOfBoundsException $ex) {
            $this->assertTrue(true);
        }

        $list->insert(0, self::VALUE_C);
        try {
            $list->set(1, self::VALUE_C);
            $this->fail();
        } catch (IndexOutOfBoundsException $ex) {
            $this->assertTrue(true);
        }
    }

    public function testDeleteOnlyElement()
    {
        $list = $this->createList();

        $list->add(self::VALUE_A);
        $this->assertEquals(1, $list->size());
        $this->assertEquals(self::VALUE_A, $list->get(0));

        $this->assertEquals(self::VALUE_A, $list->delete(0));
        $this->assertEquals(0, $list->size());
    }

    public function testDeleteFirstElement()
    {
        $list = $this->createList();

        $list->add(self::VALUE_A);
        $list->add(self::VALUE_B);
        $list->add(self::VALUE_C);

        $this->assertEquals(3, $list->size());
        $this->assertEquals(self::VALUE_A, $list->get(0));
        $this->assertEquals(self::VALUE_B, $list->get(1));
        $this->assertEquals(self::VALUE_C, $list->get(2));

        $this->assertEquals(self::VALUE_A, $list->delete(0));
        $this->assertEquals(2, $list->size());
        $this->assertEquals(self::VALUE_B, $list->get(1));
        $this->assertEquals(self::VALUE_C, $list->get(2));
    }

    public function testDeleteLastElement()
    {
        $list = $this->createList();

        $list->add(self::VALUE_A);
        $list->add(self::VALUE_B);
        $list->add(self::VALUE_C);

        $this->assertEquals(3, $list->size());
        $this->assertEquals(self::VALUE_A, $list->get(0));
        $this->assertEquals(self::VALUE_B, $list->get(1));
        $this->assertEquals(self::VALUE_C, $list->get(2));

        $this->assertEquals(self::VALUE_C, $list->delete(2));
        $this->assertEquals(2, $list->size());
        $this->assertEquals(self::VALUE_A, $list->get(0));
        $this->assertEquals(self::VALUE_B, $list->get(1));
    }

    public function testDeleteMiddleElement()
    {
        $list = $this->createList();

        $list->add(self::VALUE_A);
        $list->add(self::VALUE_C);
        $list->add(self::VALUE_B);

        $this->assertEquals(3, $list->size());
        $this->assertEquals(self::VALUE_A, $list->get(0));
        $this->assertEquals(self::VALUE_C, $list->get(1));
        $this->assertEquals(self::VALUE_B, $list->get(2));
        
        $this->assertEquals(self::VALUE_C, $list->delete(1));
        $this->assertEquals(2, $list->size());
        $this->assertEquals(self::VALUE_A, $list->get(0));
        $this->assertEquals(self::VALUE_B, $list->get(2));
    }

    public function testDeleteOutOfBounds()
    {
        $list = $this->createList();

        try {
            $list->delete(-1);
            $this->fail();
        } catch (IndexOutOfBoundsException $ex) {
            $this->assertTrue(true);
        }

        try {
            $list->delete(0);
            $this->fail();
        } catch (IndexOutOfBoundsException $ex) {
            $this->assertTrue(true);
        }
    }

    public function testDeleteByValue()
    {
        $list = $this->createList();

        $list->add(self::VALUE_A);
        $list->add(self::VALUE_B);
        $list->add(self::VALUE_A);

        $this->assertEquals(3, $list->size());
        $this->assertEquals(self::VALUE_A, $list->get(0));
        $this->assertEquals(self::VALUE_B, $list->get(1));
        $this->assertEquals(self::VALUE_A, $list->get(2));

        $this->assertTrue($list->deleteByValue(self::VALUE_A));

        $this->assertEquals(2, $list->size());
        $this->assertEquals(self::VALUE_B, $list->get(1));
        $this->assertEquals(self::VALUE_A, $list->get(2));

        $this->assertTrue($list->deleteByValue(self::VALUE_A));

        $this->assertEquals(1, $list->size());
        $this->assertEquals(self::VALUE_B, $list->get(1));

        $this->assertFalse($list->deleteByValue(self::VALUE_C));

        $this->assertEquals(1, $list->size());
        $this->assertEquals(self::VALUE_B, $list->get(1));

        $this->assertTrue($list->deleteByValue(self::VALUE_B));

        $this->assertEquals(0, $list->size());
    }

    public function testEmptyIteration()
    {
        $list = $this->createList();
        $iterator = $list->iterator();

        $this->assertTrue($iterator->isDone());

        try {
            $iterator->current();
            $this->fail();
        } catch (IteratorOutOfBoundsException $ex) {
            $this->assertTrue(true);
        }
    }

    public function testForwardIteration()
    {
        $list =  $this->createList();

        $list->add(self::VALUE_A);
        $list->add(self::VALUE_B);
        $list->add(self::VALUE_C);

        $iterator = $list->iterator();

        $iterator->first();
        $this->assertFalse($iterator->isDone());
        $this->assertEquals(self::VALUE_A, $iterator->current());

        $iterator->next();
        $this->assertFalse($iterator->isDone());
        $this->assertEquals(self::VALUE_B, $iterator->current());

        $iterator->next();
        $this->assertFalse($iterator->isDone());
        $this->assertEquals(self::VALUE_C, $iterator->current());

        $iterator->next();
        $this->assertTrue($iterator->isDone());

        try {
            $iterator->current();
            $this->fail();
        } catch (IteratorOutOfBoundsException $ex) {
            $this->assertTrue(true);
        }
    }

    public function testBackwardIteration()
    {
        $list = $this->createList();

        $list->add(self::VALUE_A);
        $list->add(self::VALUE_B);
        $list->add(self::VALUE_C);

        $iterator = $list->iterator();
        
        $iterator->last();
        $this->assertFalse($iterator->isDone());
        $this->assertEquals(self::VALUE_C, $iterator->current());

        $iterator->previous();
        $this->assertFalse($iterator->isDone());
        $this->assertEquals(self::VALUE_B, $iterator->current());

        $iterator->previous();
        $this->assertFalse($iterator->isDone());
        $this->assertEquals(self::VALUE_A, $iterator->current());

        $iterator->previous();
        $this->assertTrue($iterator->isDone());

        try {
            $iterator->current();
            $this->fail();
        } catch (IteratorOutOfBoundsException $ex) {
            $this->assertTrue(true);
        }
    }

    public function testIndexOf()
    {
        $list = $this->createList();
        
        $list->add(self::VALUE_A);
        $list->add(self::VALUE_B);
        $list->add(self::VALUE_A);

        $this->assertEquals(0, $list->indexOf(self::VALUE_A));
        $this->assertEquals(1, $list->indexOf(self::VALUE_B));
        $this->assertEquals(-1, $list->indexOf(self::VALUE_C));
    }

    public function testContains()
    {
        $list = $this->createList();

        $list->add(self::VALUE_A);
        $list->add(self::VALUE_B);
        $list->add(self::VALUE_A);

        $this->assertTrue($list->contains(self::VALUE_A));
        $this->assertTrue($list->contains(self::VALUE_B));
        $this->assertFalse($list->contains(self::VALUE_C));
    }

    public function testClear()
    {
        $list = $this->createList();

        $list->add(self::VALUE_A);
        $list->add(self::VALUE_B);
        $list->add(self::VALUE_C);

        $this->assertFalse($list->isEmpty());
        $this->assertEquals(3, $list->size());

        $list->clear();

        $this->assertTrue($list->isEmpty());
        $this->assertEquals(0, $list->size());
    }

    public function testEquals()
    {
        $list = $this->createList();
        $otherList = $this->createList();

        $list->add(self::VALUE_A);
        $list->add(self::VALUE_B);
        $list->add(self::VALUE_C);

        $otherList->add(self::VALUE_A);
        $otherList->add(self::VALUE_B);
        $otherList->add(self::VALUE_C);

        $this->assertTrue($list->equals($otherList));

        $otherList->delete(2);
        $this->assertFalse($list->equals($otherList));

        $list->delete(2);
        $this->assertTrue($list->equals($otherList));

        $otherList->set(1, self::VALUE_C);
        $this->assertFalse($list->equals($otherList));
    }
}
