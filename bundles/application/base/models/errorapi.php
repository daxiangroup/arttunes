<?php

namespace Base;

class ErrorApi
{
    public static function exception($message='', $type='Exception')
    {
        $backtrace = debug_backtrace();
        array_shift($backtrace);
        $caller = $backtrace[0];

        /*
        $parsed  = '['.$caller['class'].'::'.$caller['function'].'] [Line: '.$caller['line'].'] ';
        $parsed .= count($caller['args']) ? '[Data: '.print_r($caller['args'],true).'] ' : '';
        $parsed .= $message.' [In: '.$caller['file'].']';
        */

        $parsed  = $caller['file'].PHP_EOL;
        $parsed .= 'Class: '.$caller['class'].'::'.$caller['function'].'()'.PHP_EOL;
        $parsed .= 'Data: '.(count($caller['args']) ? print_r($caller['args'],true) : ''.PHP_EOL);
        $parsed .= 'Message: '.$message.PHP_EOL;
        
        //die('<pre>'.print_r($backtrace,true));
        switch ($type) {
            case 'Exception': throw new \Exception($parsed); break;
            case 'InvalidArgumentException': throw new \InvalidArgumentException($parsed); break;
        }
    }

    public static function log($message='')
    {
        
    }
}