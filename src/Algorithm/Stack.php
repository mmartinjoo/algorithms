<?php

namespace Jmweb\Algorithm;

use Jmweb\Algorithm\Queue;

interface Stack extends Queue
{
    /**
     * @param mixed $value 
     * @return void
     */
    public function push($value);

    /**
     * @return mixed
     */
    public function pop();

    /**
     * @return mixed
     */
    public function peek();

    /**
     * @return void
     */
    public function clear();

    /**
     * @return bool
     */
    public function isEmpty();

    /**
     * @return int
     */
    public function size();
}
