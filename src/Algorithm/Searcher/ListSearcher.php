<?php

namespace Jmweb\Algorithm\Searcher;

use Jmweb\Algorithm\IList;

interface ListSearcher
{
    /**
     * @param mixed $key 
     * @return int
     */
    public function search(IList $list, $key);
}
