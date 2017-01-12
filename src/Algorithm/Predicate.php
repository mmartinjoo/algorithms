<?php

namespace Jmweb\Algorithm;

interface Predicate
{
    /**
     * @return bool
     */
    public function evaulate($element);
}
