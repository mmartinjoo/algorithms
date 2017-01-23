<?php

namespace Jmweb\Algorithm\Comparator;

use Jmweb\Algorithm\LinkedList;

class Text
{
    /**
     * @param string $left 
     * @param string $right 
     * @return int
     */
    public static function compareStrings($left, $right)
    {
        $leftAsciis = self::getAsciiCodes($left); 
        $rightAsciis = self::getAsciiCodes($right); 

        $iteratorLeft = $leftAsciis->iterator();
        $iteratorRight = $rightAsciis->iterator();

        $iteratorLeft->first();
        $iteratorRight->first();

        for (; !$iteratorLeft->isDone() && !$iteratorRight->isDone(); $iteratorLeft->next(), $iteratorRight->next()) {
            $difference = $iteratorLeft->current() - $iteratorRight->current(); 

            // This is the first difference in the two string, so this defines which is greater
            if ($difference != 0) {
                return $difference;
            } 
        }

        // ALl chars in left and right was equal, but right is longer, so it's greater than right
        if (!$iteratorRight->isDone() && $iteratorLeft->isDone()) {
            return -1;
        }

        // ALl chars in left and right was equal, but right is longer, so it's greater than right
        if (!$iteratorLeft->isDone() && $iteratorRight->isDone()) {
            return 1;
        }

        // All chars are equal in left and right
        return 0;
    }

    /**
     * @param string $string 
     * @return Jmweb\Algorithm\LinkedList
     */
    public static function getAsciiCodes($string)
    {
        $asciis = new LinkedList;

        for ($i = 0; $i < strlen($string); $i++) {
            $char = mb_strimwidth($string, $i, 1);

            if ($char != null) {
                $asciis->add(self::getAsciiCode($char));
            }
        }

        return $asciis;
    }

    /**
     * @param char $char 
     * @return int
     */
    public static function getAsciiCode($char)
    {
        switch ($char) {
            case 'ű':
                return ord('u');
                break;
            case 'Ű':
                return ord('U');
                break;
            case 'á':
                return ord('a');
                break;
            case 'Á':
                return ord('A');
                break;
            case 'é':
                return ord('e');
                break;
            case 'É':
                return ord('E');
                break;
            case 'ú':
                return ord('u');
                break;
            case 'Ú':
                return ord('U');
                break;
            case 'ő':
                return ord('o');
                break;
            case 'Ő':
                return ord('O');
                break;
            case 'ó':
                return ord('o');
                break;
            case 'Ó':
                return ord('O');
                break;
            case 'ü':
                return ord('u');
                break;
            case 'Ü':
                return ord('U');
                break;
            case 'ö':
                return ord('o');
                break;
            case 'Ö':
                return ord('O');
                break;
            case 'í':
                return ord('i');
                break;
            case 'Í':
                return ord('I');
                break;
        } 

        return ord($char);
    }
}
