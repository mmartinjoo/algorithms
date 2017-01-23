<?php

namespace Jmweb\Algorithm;

use Jmweb\Algorithm\IList;

abstract class AbstractList implements IList
{
    /**
     * @return int
     */
    abstract protected function getMinimumIndex();

    /**
     * @param IList $list 
     * @return bool
     */
    public function equals(IList $list)
    {
        if ($this->size() != $list->size()) {
            return false;
        }

        $iterator = $this->iterator();
        $otherIterator = $list->iterator();

        $iterator->first();
        $otherIterator->first();
        $i = 0;

        while ((!$iterator->isDone() && !$otherIterator->isDone())
                && ($iterator->current() == $otherIterator->current())) {
            $iterator->next();
            $otherIterator->next();
            $i++;
        }

        return ($i == $this->size() && $i == $list->size());
    }

    /**
     * @param mixed $value 
     * @return int
     */
    public function indexOf($value)
    {
        $iterator = $this->iterator();
        $i = $this->getMinimumIndex();

        for ($iterator->first(); !$iterator->isDone(); $iterator->next()) {
            if ($iterator->current() == $value) {
                return $i;
            }

            $i++;
        }

        return -1;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $iterator = $this->iterator();
        $string = "[";

        for ($iterator->first(); !$iterator->isDone(); $iterator->next()) {
            $string .= $iterator->current() . ", " ;
        }

        $string = substr($string, 0, strlen($string) - 2);

        return $string . "]";
    }

    /**
     * @return int
     */
    public function sum()
    {
        $iterator = $this->iterator();
        $sum = 0;

        for ($iterator->first(); !$iterator->isDone(); $iterator->next()) {
            if (is_scalar($iterator->current())) {
                $sum += $iterator->current();
            }
        }

        return $sum;
    }
}
