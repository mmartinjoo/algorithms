<?php

namespace Jmweb\Tests\Algorithm;

use PHPUnit\Framework\TestCase;
use Jmweb\Algorithm\Comparator\CompoundComparator;
use Jmweb\Algorithm\Comparator\FixedComparator;

class CompoundComparatorTest extends TestCase 
{
    /**
     * @covers CompoundComparator::compare()
     */
    public function testComparasionContinuesWhileEqual()
    {
        $comparator = new CompoundComparator;
        $comparator->addComparator(new FixedComparator(0));
        $comparator->addComparator(new FixedComparator(0));
        $comparator->addComparator(new FixedComparator(0));

        $this->assertTrue($comparator->compare('IGNORED', 'IGNORED') == 0);
    }

    /**
     * @covers CompoundComparator::compare()
     */
    public function testComparasionStopsWhenLessThen()
    {
        $comparator = new CompoundComparator;
        $comparator->addComparator(new FixedComparator(0));
        $comparator->addComparator(new FixedComparator(0));
        $comparator->addComparator(new FixedComparator(0));

        $this->assertTrue($comparator->compare('IGNORED', 'IGNORED') == 0);
    }
    /**
     * @covers CompoundComparator::compare()
     */
    public function testComparasionStopsWhenLessThan()
    {
        $comparator = new CompoundComparator;
        $comparator->addComparator(new FixedComparator(0));
        $comparator->addComparator(new FixedComparator(0));
        $comparator->addComparator(new FixedComparator(-57));
        $comparator->addComparator(new FixedComparator(91));

        $this->assertTrue($comparator->compare('IGNORED', 'IGNORED') < 0);
    }

    /**
     * @covers CompoundComparator::compare()
     */
    public function testComparasionStopsWhenGreaterThan()
    {
        $comparator = new CompoundComparator;
        $comparator->addComparator(new FixedComparator(0));
        $comparator->addComparator(new FixedComparator(0));
        $comparator->addComparator(new FixedComparator(91));
        $comparator->addComparator(new FixedComparator(-57));

        $this->assertTrue($comparator->compare('IGNORED', 'IGNORED') > 0);
    }
}
