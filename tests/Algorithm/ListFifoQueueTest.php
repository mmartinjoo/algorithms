<?php

namespace Jmweb\Tests\Algorithm;

use Jmweb\Tests\Algorithm\AbstractFifoQueueTestCase;
use Jmweb\Algorithm\ListFifoQueue;

class ListFifoQueueTest extends AbstractFifoQueueTestCase
{
    protected function createFifoQueue()
    {
        return new ListFifoQueue();
    }
}
