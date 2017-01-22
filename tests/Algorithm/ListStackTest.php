<?php

namespace Jmweb\Tests\Algorithm;

use Jmweb\Tests\Algorithm\AbstractStackTestCase;
use Jmweb\Algorithm\ListStack;

class ListStackTest extends AbstractStackTestCase
{
    protected function createStack()
    {
        return new ListStack;
    }
}
