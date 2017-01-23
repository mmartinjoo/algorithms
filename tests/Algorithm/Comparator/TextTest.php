<?php

namespace Jmweb\Tests\Algorithm\Comparator;

use Jmweb\Algorithm\Comparator\NaturalComparator;
use PHPUnit\Framework\TestCase;
use Jmweb\Algorithm\Comparator\Text;

class TextTest extends TestCase
{
    /**
     * @covers Text::getExtendedAsciiCode()
     */
    public function testGetAsciiCode()
    {
         $this->assertEquals(ord('u'), Text::getAsciiCode('ű'));
         $this->assertEquals(ord('U'), Text::getAsciiCode('Ű'));
         $this->assertEquals(ord('a'), Text::getAsciiCode('á'));
         $this->assertEquals(ord('A'), Text::getAsciiCode('Á'));
         $this->assertEquals(ord('e'), Text::getAsciiCode('é'));
         $this->assertEquals(ord('E'), Text::getAsciiCode('É'));
         $this->assertEquals(ord('u'), Text::getAsciiCode('ú'));
         $this->assertEquals(ord('U'), Text::getAsciiCode('Ú'));
         $this->assertEquals(ord('o'), Text::getAsciiCode('ő'));
         $this->assertEquals(ord('O'), Text::getAsciiCode('Ő'));
         $this->assertEquals(ord('o'), Text::getAsciiCode('ó'));
         $this->assertEquals(ord('O'), Text::getAsciiCode('Ó'));
         $this->assertEquals(ord('u'), Text::getAsciiCode('ü'));
         $this->assertEquals(ord('U'), Text::getAsciiCode('Ü'));
         $this->assertEquals(ord('o'), Text::getAsciiCode('ö'));
         $this->assertEquals(ord('O'), Text::getAsciiCode('Ö'));
         $this->assertEquals(ord('i'), Text::getAsciiCode('í'));
         $this->assertEquals(ord('I'), Text::getAsciiCode('Í'));

         $this->assertEquals(97, Text::getAsciiCode('a'));
    }

    /**
     * @covers Text::getAsciiCodes()
     */
    public function testGetAsciiCodes()
    {
        $asciis = Text::getAsciiCodes('abc');
        $this->assertEquals(ord('a'), $asciis->get(0));
        $this->assertEquals(ord('b'), $asciis->get(1));
        $this->assertEquals(ord('c'), $asciis->get(2));
        $this->assertEquals(3, $asciis->size());

        $asciis = Text::getAsciiCodes('űáéúőóüöíabc');
        $this->assertEquals(ord('u'), $asciis->get(0));
        $this->assertEquals(ord('a'), $asciis->get(1));
        $this->assertEquals(ord('e'), $asciis->get(2));
        $this->assertEquals(ord('u'), $asciis->get(3));
        $this->assertEquals(ord('o'), $asciis->get(4));
        $this->assertEquals(ord('o'), $asciis->get(5));
        $this->assertEquals(ord('u'), $asciis->get(6));
        $this->assertEquals(ord('o'), $asciis->get(7));
        $this->assertEquals(ord('i'), $asciis->get(8));
        $this->assertEquals(97, $asciis->get(9));
        $this->assertEquals(98, $asciis->get(10));
        $this->assertEquals(99, $asciis->get(11));
        $this->assertEquals(12, $asciis->size());

        $asciis = Text::getAsciiCodes('ŰÁÉÚŐÓÜÖÍABC');
        $this->assertEquals(ord('U'), $asciis->get(0));
        $this->assertEquals(ord('A'), $asciis->get(1));
        $this->assertEquals(ord('E'), $asciis->get(2));
        $this->assertEquals(ord('U'), $asciis->get(3));
        $this->assertEquals(ord('O'), $asciis->get(4));
        $this->assertEquals(ord('O'), $asciis->get(5));
        $this->assertEquals(ord('U'), $asciis->get(6));
        $this->assertEquals(ord('O'), $asciis->get(7));
        $this->assertEquals(ord('I'), $asciis->get(8));
        $this->assertEquals(65, $asciis->get(9));
        $this->assertEquals(66, $asciis->get(10));
        $this->assertEquals(67, $asciis->get(11));
        $this->assertEquals(12, $asciis->size());
    }

    /**
     * @covers Text::compareStrings
     */
    public function testCompareStringsLessThan()
    {
        /* $this->assertTrue(Text::compareStrings('Ember', 'Őrszem') < 0); */
        $this->assertTrue(Text::compareStrings('Állat', 'Ember') < 0);
        /* $this->assertTrue(Text::compareStrings('alma', 'banán') < 0); */
        /* $this->assertTrue(Text::compareStrings('abcde', 'abcdf') < 0); */
        /* $this->assertTrue(Text::compareStrings('abcde', 'abcdef') < 0); */
    }

    /**
     * @covers Text::compareStrings
     */
    public function testCompareStringsGreaterThan()
    {
        $this->assertTrue(Text::compareStrings('This is another sentence', 'This is a sentence') > 0);
        $this->assertTrue(Text::compareStrings('banán', 'alma') > 0);
        $this->assertTrue(Text::compareStrings('abcdf', 'abcde') > 0);
        $this->assertTrue(Text::compareStrings('abcdefg', 'abcdef') > 0);
    }

    /**
     * @covers Text::compareStrings
     */
    public function testCompareStringsEqualsTo()
    {
        $this->assertTrue(Text::compareStrings('This is a sentence', 'This is a sentence') == 0);
        $this->assertTrue(Text::compareStrings('banán', 'banán') == 0);
        $this->assertTrue(Text::compareStrings('abcde', 'abcde') == 0);
        $this->assertTrue(Text::compareStrings('abcdefg', 'abcdefg') == 0);
    }
}
