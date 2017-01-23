<?php

namespace Jmweb\Algorithm\Sorter;

use Jmweb\Algorithm\IList;

interface ListSorter
{
    /**
     * @param IList $lis 
     * @return IList
     */
    public function sort(IList $lis);
}
