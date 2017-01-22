<?php

namespace Jmweb\Algorithm;

class Element
{
    /**
     * @var mixed
     */
    protected $_value;

    /**
     * @var Element;
     */
    protected $_next;

    /**
     * @var Element;
     */
    protected $_previous;

    /**
     * @param mixed $value 
     */
    public function __construct($value)
    {
        $this->_value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @param mixed $value 
     * @return Element
     */
    public function setValue($value)
    {
        $this->_value = $value;
        return $this;
    }

    /**
     * @return Element
     */
    public function getPrevious()
    {
        return $this->_previous;
    }

    /**
     * @param Element $previous 
     * @return Element
     */
    public function setPrevious(Element $previous)
    {
        $this->_previous = $previous;
        return $this;
    }

    /**
     * @return Element
     */
    public function getNext()
    {
        return $this->_next;
    }

    /**
     * @param Element $next 
     * @return Element
     */
    public function setNext(Element $next)
    {
        $this->_next = $next;
        return $this;
    }

    /**
     * @param Element $next 
     * @return void
     */
    public function attachBefore(Element $next)
    {
        $previous = $next->getPrevious();

        $previous->setNext($this);
        $next->setPrevious($this);

        $this->setPrevious($previous);
        $this->setNext($next);
    }

    public function detach()
    {
        $this->_previous->setNext($this->_next);
        $this->_next->setPrevious($this->_previous);
    }
}
