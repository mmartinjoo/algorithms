<?php

namespace Jmweb\Algorithm;

interface Queue 
{
    /**
     * @param mixed $value 
     * @return void
     */
    public function enqueue($value);

    /**
     * @return mixed
     */
    public function dequeue();

    /**
     * @return void
     */
    public function clear();

    /**
     * @return int
     */
    public function size();

    /**
     * @return bool
     */
    public function isEmpty();
}
