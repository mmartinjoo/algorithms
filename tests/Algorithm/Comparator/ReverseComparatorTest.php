<?php

namespace Jmweb\Tests\Algorithm\Comparator;

use Jmweb\Algorithm\Comparator\NaturalComparator;
use Jmweb\Algorithm\Comparator\ReverseComparator;
use PHPUnit\Framework\TestCase;

class ReverseComparatorTest extends TestCase
{
    protected function createComparator()
    {
        return new ReverseComparator(NaturalComparator::instance());
    }

    /**
     * @covers ReverseComparator::compare()
     */
    public function testLessThanBevomesGreaterThan()
    {
        $comparator = $this->createComparator();

        $this->assertTrue($comparator->compare('A', 'B') > 0);
        $this->assertTrue($comparator->compare(1, 2) > 0);
        $this->assertTrue($comparator->compare(1.45, 4.32) > 0);
        $this->assertTrue($comparator->compare('Alma', 'Banán') > 0);
        $this->assertTrue($comparator->compare('Állat', 'Ember') > 0);
    }

    /**
     * @covers ReverseComparator::compare()
     */
    public function testGreaterThanBecomesLessThan()
    {
        $comparator = $this->createComparator();

        $this->assertTrue($comparator->compare('B', 'A') < 0);
        $this->assertTrue($comparator->compare(2, 1) < 0);
        $this->assertTrue($comparator->compare(4.32, 1.45) < 0);
        $this->assertTrue($comparator->compare('Banán', 'Alma') < 0);
        $this->assertTrue($comparator->compare('Őrszem', 'Könyv') < 0);
    }

    /**
     * @covers ReverseComparator::compare()
     */
    public function testEqualsTo()
    {
        $comparator = $this->createComparator();

        $this->assertTrue($comparator->compare('B', 'B') == 0);
        $this->assertTrue($comparator->compare(2, 2) == 0);
        $this->assertTrue($comparator->compare(1.45, 1.45) == 0);
        $this->assertTrue($comparator->compare('Körte', 'Körte') == 0);
        $this->assertTrue($comparator->compare('űáéúőóüö', 'űáéúőóüö') == 0);
    }
}
