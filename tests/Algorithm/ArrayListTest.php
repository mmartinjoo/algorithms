<?php

namespace Jmweb\Tests\Algorithm;

use PHPUnit\Framework\TestCase;
use Jmweb\Tests\Algorithm\AbstractListTestCase;
use Jmweb\Algorithm\ArrayList;

class ArrayListTest extends AbstractListTestCase
{
     /**
      * @return Jmweb\Algorithm\ArrayList;
      */
     protected function createList()
     {
         return new ArrayList();
     }
}
