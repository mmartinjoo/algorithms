<?php

namespace Jmweb\Algorithm;

$file = $argv[1];
$parts = explode("/", $file);
$file = array_pop($parts);

$dir = implode("/", $parts);

DirTree::printFile($file, $dir, "");

class DirTree
{
    const SPACES = "  ";
    
    /**
     * @param mixed $file 
     * @param mixed $parent 
     * @param mixed $indent 
     * @return void
     */
    public static function printFile($file, $parent, $indent)
    {
        $rawFile = $file;
        $file = ($parent) ? $parent . "/" . $file : $file;
        $isDir = is_dir($file);
        $notation = ($isDir) ? "+" : "-";

        echo $indent;
        echo $notation . $rawFile . "\r\n";

        if ($isDir) {
            self::printDir(scandir($file), $file, $indent . self::SPACES);
        }
    }

    /**
     * @param array $files 
     * @param mixed $parent 
     * @param mixed $indent 
     * @return void
     */
    public static function printDir(array $files, $parent, $indent)
    {
        foreach ($files as $file) {
            if ($file != '.' && $file != '..' && $file != '.DS_Store') {
                self::printFile($file, $parent, $indent);
            }
        } 
    }
}
