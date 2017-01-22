<?php

namespace Jmweb\Algorithm\Action;

use Jmweb\Algorithm\Action\Action;
use Jmweb\Algorithm\IList;

abstract class UndoAction implements Action
{
    /**
     * @var IList
     */
    protected $_list;

    public function __construct(IList $_list)
    {
        $this->_list = $_list;
    }
}
