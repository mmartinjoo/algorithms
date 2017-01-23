<?php

namespace Jmweb\Algorithm\Comparator;

interface Comparator
{
    /**
     * @param mixed $left 
     * @param mixed $right 
     * @return int
     */
    public function compare($left, $right);
}
