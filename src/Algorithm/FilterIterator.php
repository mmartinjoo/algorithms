<?php

namespace Jmweb\Algorithm;

use Jmweb\Algorithm\Iterator;
use Jmweb\Algorithm\Predicate;

class FilterIterator implements Iterator
{
    const DIRECTION_FORWARD = 'forwards';
    const DIRECTION_BACKWARD = 'backwards';

    /**
     * @var Iterator
     */
    protected $iterator;

    /**
     * @var Predicate
     */
    protected $predicate;

    /**
     * @param Iterator $iterator
     * @param Predicate $predicate
     */
    public function __construct(Iterator $iterator, Predicate $predicate)
    {
        $this->iterator = $iterator;
        $this->predicate = $predicate;
    }

    /**
     * @return bool
     */
    public function isDone()
    {
        return $this->iterator->isDone();
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->iterator->current();
    }

    public function first()
    {
        $this->iterator->first();
        $this->filterTo(self::DIRECTION_FORWARD);
    }

    public function next()
    {
        $this->iterator->next();
        $this->filterTo(self::DIRECTION_FORWARD);
    }

    public function last()
    {
        $this->iterator->last();
        $this->filterTo(self::DIRECTION_BACKWARD);
    }

    public function previous()
    {
        $this->iterator->previous();
        $this->filterTo(self::DIRECTION_BACKWARD);
    }

    /**
     * @param string $direction
     */
    public function filterTo($direction)
    {
        $method = ($direction == self::DIRECTION_FORWARD) ? 'next' : 'previous';
        while (!$this->iterator->isDone() && 
            !$this->predicate->evaulate($iterator->current())) {
            $this->iterator->{$method}();
        }
    }
}
