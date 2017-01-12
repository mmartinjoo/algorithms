<?php

namespace Jmweb;

class Some
{
    protected $_value;
    
    public function __construct($_value)
    {
        $this->_value = $_value;
    }

    public function __toString()
    {
        return $this->_value;
    }
}
