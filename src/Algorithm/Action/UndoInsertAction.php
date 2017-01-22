<?php

namespace Jmweb\Algorithm\Action;

use Jmweb\Algorithm\Action\Action;
use Jmweb\Algorithm\Action\UndoAction;
use Jmweb\Algorithm\IList;

class UndoInsertAction extends UndoAction
{
    /**
     * @var int
     */
    protected $_index;

    public function __construct(IList $list, $index)
    {
        parent::__construct($list);
        $this->_index = $index;
    }

    public function execute()
    {
        $this->_list->delete($this->_index);
    }
}
