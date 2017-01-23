<?php

namespace Jmweb\Tests\Algorithm\Comparator;

use Jmweb\Algorithm\Comparator\NaturalComparator;
use PHPUnit\Framework\TestCase;

class NaturalComparatorTest extends TestCase
{
    /**
     * @covers NaturalComparator::compare()
     */
    public function testLessThan()
    {
        $this->assertTrue(NaturalComparator::instance()->compare('A', 'B') < 0);
        $this->assertTrue(NaturalComparator::instance()->compare(1, 2) < 0);
        $this->assertTrue(NaturalComparator::instance()->compare(1.45, 4.32) < 0);
        $this->assertTrue(NaturalComparator::instance()->compare('Alma', 'Banán') < 0);
        $this->assertTrue(NaturalComparator::instance()->compare('Állat', 'Ember') < 0);
    }

    /**
     * @covers NaturalComparator::compare()
     */
    public function testGreaterThan()
    {
        $this->assertTrue(NaturalComparator::instance()->compare('B', 'A') > 0);
        $this->assertTrue(NaturalComparator::instance()->compare(2, 1) > 0);
        $this->assertTrue(NaturalComparator::instance()->compare(4.32, 1.45) > 0);
        $this->assertTrue(NaturalComparator::instance()->compare('Banán', 'Alma') > 0);
        $this->assertTrue(NaturalComparator::instance()->compare('Őrszem', 'Könyv') > 0);
    }

    /**
     * @covers NaturalComparator::compare()
     */
    public function testEqualsTo()
    {
        $this->assertTrue(NaturalComparator::instance()->compare('B', 'B') == 0);
        $this->assertTrue(NaturalComparator::instance()->compare(2, 2) == 0);
        $this->assertTrue(NaturalComparator::instance()->compare(1.45, 1.45) == 0);
        $this->assertTrue(NaturalComparator::instance()->compare('Körte', 'Körte') == 0);
        $this->assertTrue(NaturalComparator::instance()->compare('űáéúőóüö', 'űáéúőóüö') == 0);
    }
}
