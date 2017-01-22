<?php

namespace Jmweb\Algorithm;

use Jmweb\Algorithm\IList;
use Jmweb\Algorithm\ListStack;
use Jmweb\Algorithm\Action\UndoInsertAction;
use Jmweb\Algorithm\Action\UndoDeleteAction;
use Jmweb\Algorithm\Action\UndoSetAction;

class UndoableList implements IList
{
    /**
     * @var Jmweb\Algorithm\IList
     */
    protected $_list;

    /**
     * @var Jmweb\Algorithm\ListStack
     */
    protected $_undoStack;

    public function __construct(IList $_list = null)
    {
        $_list = (!$_list) ? new ArrayList : $_list;
        $this->_list = $_list;
        $this->_undoStack = new ListStack;
    }

    /**
     * @param inr $index 
     * @param mixed $value 
     * @return void
     */
    public function insert($index, $value) 
    {
        $this->_list->insert($index, $value);
        $this->_undoStack->push(
            new UndoInsertAction($this->_list, $index));
    }

    /**
     * @param mixed $value 
     * @return void
     */
    public function add($value) 
    {
        $this->insert($this->size(), $value);
    }

    /**
     * @param int $index 
     * @return void
     */
    public function delete($index)
    {
        $value = $this->_list->delete($index);
        $this->_undoStack->push(
            new UndoDeleteAction($this->_list, $index, $value));

        return $value;
    }

    /**
     * @param mixed $value 
     * @return bool
     */
    public function deleteByValue($value)
    {
        $index = $this->indexOf($value);
        if ($index == -1) {
            return false;
        }

        $this->delete($index);
        return true;
    }

    /**
     * @param int $index 
     * @param mixed $value 
     * @return mixed
     */
    public function set($index, $value)
    {
        $oldValue = $this->_list->set($index, $value);
        $this->_undoStack->push(
            new UndoSetAction($this->_list, $index, $oldValue));

        return $oldValue;
    }

    public function undo()
    {
        $this->_undoStack->pop()->execute();
    }

    /**
     * @return bool
     */
    public function canUndo()
    {
        return !$this->_undoStack->isEmpty();
    }

    public function clear()
    {
        $this->_list->clear();
        $this->_undoStack->clear();
    }

    /**
     * @return int
     */
    public function size()
    {
        return $this->_list->size();
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->_list->isEmpty();
    }

    /**
     * @param mixed $value 
     * @return int
     */
    public function indexOf($value)
    {
        return $this->_list->indexOf($value);
    }

    /**
     * @return Jmweb\Algorithm\Iterator
     */
    public function iterator()
    {
        return $this->_list->iterator();
    }

    /**
     * @param mixed $value 
     * @return bool
     */
    public function contains($value)
    {
        return $this->_list->contains($value);
    }

    /**
     * @param IList $list 
     * @return bool
     */
    public function equals(IList $list)
    {
        return $this->_list->equals($list);
    }

    /**
     * @param int $index 
     * @return mixed
     */
    public function get($index)
    {
        return $this->_list->get($index);
    }
}
