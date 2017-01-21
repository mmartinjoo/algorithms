<?php

namespace Jmweb\Tests\Algorithm;

use PHPUnit\Framework\TestCase;
use Jmweb\Tests\Algorithm\AbstractListTestCase;
use Jmweb\Algorithm\ArrayList;

class ArrayListTest extends AbstractListTestCase
{
     protected function createList()
     {
         return new ArrayList();
     }
}
