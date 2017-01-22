<?php

namespace Jmweb\Tests\Algorithm;

use PHPUnit\Framework\TestCase;
use Jmweb\Tests\Algorithm\AbstractListTestCase;
use Jmweb\Algorithm\UndoableList;
use Jmweb\Algorithm\ArrayList;

class UndoableListTest extends AbstractListTestCase
{
    protected function createList()
    {
        return new UndoableList(new ArrayList);
    }

    public function testUndoInsert()
    {
        $list = $this->createList();

        $this->assertFalse($list->canUndo());

        $list->insert(0, self::VALUE_A);
        $this->assertTrue($list->canUndo());

        $list->undo();
        $this->assertEquals(0, $list->size());
        $this->assertFalse($list->canUndo());
    }

    public function testUndoAdd()
    {
        $list = $this->createList();

        $this->assertFalse($list->canUndo());

        $list->add(self::VALUE_A);
        $this->assertTrue($list->canUndo());

        $list->undo();
        $this->assertEquals(0, $list->size());
        $this->assertFalse($list->canUndo());
    }

    public function testUndoDeleteByPosition()
    {
        $list = $this->createList();

        $list->add(self::VALUE_A);
        $list->add(self::VALUE_B);

        $this->assertEquals(2, $list->size());
        $this->assertFalse($list->isEmpty());
        $this->assertTrue($list->canUndo());

        $this->assertEquals(self::VALUE_B, $list->delete(1));
        $this->assertTrue($list->canUndo());
        $this->assertEquals(1, $list->size());
        $this->assertFalse($list->isEmpty());

        $list->undo();
        $this->assertEquals(2, $list->size());
        $this->assertFalse($list->isEmpty());
        $this->assertEquals(self::VALUE_A, $list->get(0));
        $this->assertEquals(self::VALUE_B, $list->get(1));
        $this->assertTrue($list->canUndo());
    }

    public function testUndoDeleteByValue()
    {
        $list = $this->createList();

        $list->add(self::VALUE_A);
        $list->add(self::VALUE_B);

        $this->assertEquals(2, $list->size());
        $this->assertFalse($list->isEmpty());
        $this->assertTrue($list->canUndo());

        $this->assertTrue($list->deleteByValue(self::VALUE_B));
        $this->assertTrue($list->canUndo());
        $this->assertEquals(1, $list->size());
        $this->assertFalse($list->isEmpty());

        $list->undo();
        $this->assertEquals(2, $list->size());
        $this->assertFalse($list->isEmpty());
        $this->assertEquals(self::VALUE_A, $list->get(0));
        $this->assertEquals(self::VALUE_B, $list->get(1));
        $this->assertTrue($list->canUndo());
    }

    public function testUndoSet()
    {
        $list = $this->createList();
        $list->add(self::VALUE_A);

        $this->assertEquals(1, $list->size());
        $this->assertFalse($list->isEmpty());
        $this->assertTrue($list->canUndo());

        $this->assertEquals(self::VALUE_A, $list->set(0, self::VALUE_B));
        $this->assertTrue($list->canUndo());

        $list->undo();
        $this->assertEquals(1, $list->size());
        $this->assertFalse($list->isEmpty());
        $this->assertEquals(self::VALUE_A, $list->get(0));
        $this->assertTrue($list->canUndo());
    }

    public function testUndoMultiple()
    {
        $list = $this->createList();

        $this->assertFalse($list->canUndo());

        $list->add(self::VALUE_A);
        $list->add(self::VALUE_B);
        $this->assertTrue($list->canUndo());

        $list->undo();
        $this->assertEquals(1, $list->size());
        $this->assertEquals(self::VALUE_A, $list->get(0));
        $this->assertTrue($list->canUndo());

        $list->delete(0);

        $list->undo();
        $this->assertEquals(1, $list->size());
        $this->assertEquals(self::VALUE_A, $list->get(0));
        $this->assertTrue($list->canUndo());

        $list->undo();
        $this->assertEquals(0, $list->size());
        $this->assertTrue($list->isEmpty());
        $this->assertFalse($list->canUndo());
    }
}
