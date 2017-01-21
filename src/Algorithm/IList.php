<?php

namespace Jmweb\Algorithm;

use Jmweb\Algorithm\Iterable;

interface IList extends Iterable
{
    /**
     * @param int $index 
     * @param mixed $value 
     * @return void
     */
    public function insert($index, $value);

    /**
     * @param mixed $value 
     * @return void
     */
    public function add($value);

    /**
     * @param mixed $index 
     * @return mixed
     */
    public function delete($index);

    /**
     * @param mixed $value 
     * @return bool
     */
    public function deleteByValue($value);

    /**
     * @return void
     */
    public function clear();

    /**
     * @param mixed $index 
     * @param mixed $value 
     * @return mixed
     */
    public function set($index, $value);

    /**
     * @param mixed $index 
     * @return mixed
     */
    public function get($index);

    /**
     * @param mixed $value 
     * @return int
     */
    public function indexOf($value);

    /**
     * @param mixed $value
     * @return bool 
     */
    public function contains($value); 

    /**
     * @return int
     */
    public function size();

    /**
     * @return bool
     */
    public function isEmpty();
}
