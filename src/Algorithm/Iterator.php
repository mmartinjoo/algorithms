<?php

namespace Jmweb\Algorithm;

interface Iterator
{
    /**
     * @return mixed
     */
    public function first();

    /**
     * @return mixed
     */
    public function last();

    /**
     * @return bool
     */
    public function isDone();

    /**
     * @return void
     */
    public function next();

    /**
     * @return void
     */
    public function previous();

    /**
     * @return mixed
     */
    public function current();
}
