<?php

namespace Jmweb\Algorithm\Comparator;
use Jmweb\Algorithm\Comparator\Comparator;
use Jmweb\Algorithm\Comparator\Text;

class NaturalComparator implements Comparator
{
    private static $_instance = null;

    private function __construct()
    {
    }

    /**
     * @return Jmweb\Algorithm\Comparator\Comparator
     */
    public static function instance()
    {
        if (self::$_instance == null) {
            self::$_instance = new NaturalComparator;
        }

        return self::$_instance;
    }

    /**
     * @param mixed $left 
     * @param mixed $right 
     * @return int
     */
    public function compare($left, $right)
    {
        if (is_string($left) && is_string($right)) {
            return Text::compareStrings($left, $right); 
        } else {
            return $left - $right;
        }
    }
}
