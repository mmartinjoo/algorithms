<?php

namespace Jmweb\Algorithm\Action;

use Jmweb\Algorithm\Action\Action;
use Jmweb\Algorithm\Action\UndoAction;
use Jmweb\Algorithm\IList;

class UndoSetAction extends UndoAction
{
    /**
     * @var int
     */
    protected $_index;

    /**
     * @var mixed
     */
    protected $_value;

    public function __construct(IList $list, $index, $value)
    {
        parent::__construct($list);

        $this->_index = $index;
        $this->_value = $value;
    }

    public function execute()
    {
        $this->_list->set($this->_index, $this->_value);
    }
}
