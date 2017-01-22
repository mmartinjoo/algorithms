<?php

namespace Jmweb\Tests\Algorithm;

use PHPUnit\Framework\TestCase;
use Jmweb\Tests\Algorithm\AbstractListTestCase;
use Jmweb\Algorithm\LinkedList;

class LinkeddListTest extends AbstractListTestCase
{
    /**
     * @return Jmweb\Algorithm\LinkedList
     */
    protected function createList()
    {
        return new LinkedList;
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
        $this->assertEquals(self::VALUE_B, $list->get(1));
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
        $this->assertEquals(self::VALUE_B, $list->get(0));
        $this->assertEquals(self::VALUE_C, $list->get(1));
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
        $this->assertEquals(self::VALUE_B, $list->get(0));
        $this->assertEquals(self::VALUE_A, $list->get(1));

        $this->assertTrue($list->deleteByValue(self::VALUE_A));

        $this->assertEquals(1, $list->size());
        $this->assertEquals(self::VALUE_B, $list->get(0));

        $this->assertFalse($list->deleteByValue(self::VALUE_C));

        $this->assertEquals(1, $list->size());
        $this->assertEquals(self::VALUE_B, $list->get(0));

        $this->assertTrue($list->deleteByValue(self::VALUE_B));

        $this->assertEquals(0, $list->size());
    }
}
