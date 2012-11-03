<?php

namespace Base;

class ErrorApi
{
    /*
    |--------------------------------------------------------------------------
    | exception($message, $type)
    |--------------------------------------------------------------------------
    | Receives a message to throw as part of an exception. Also receives an optional
    | exception type to throw. By default, it will be a generic Exception
    |
    | @param:     $message - message that is logged as part of the exception
    | @param:     $type - optional type of exception to throw
    */
    public static function exception($message='', $type='Exception')
    {
        $parsed = static::format_message($message);
        
        switch ($type) {
            case 'Exception': throw new \Exception($parsed); break;
            case 'InvalidArgumentException': throw new \InvalidArgumentException($parsed); break;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | log($message)
    |--------------------------------------------------------------------------
    | Logs a message in the storage defined by the application. Very similar to 
    | the exception() method, however this only logs the message and continues
    | processing.
    |
    | @param:     $message - message that is logged as part of the exception
    */
    public static function log($message='')
    {
        \Log::write('error', static::format_message($message));
    }

    /*
    |--------------------------------------------------------------------------
    | format_message($message)
    |--------------------------------------------------------------------------
    | Receives a message that will be returned to include in the exception/log.
    | This funciton parses out the debug_backtrace() to get the calling class/method
    | that caused the need to exception/log in the first place. The message supplied
    | is worked into the data.
    |
    | @param:     $message - message that is logged as part of the exception
    | @return:    string
    */
    public static function format_message($message)
    {
        $backtrace = debug_backtrace();
        array_shift($backtrace);
        array_shift($backtrace);
        $caller = $backtrace[0];

        $parsed  = $caller['file'].PHP_EOL;
        $parsed .= 'Class: '.$caller['class'].'::'.$caller['function'].'()'.PHP_EOL;
        $parsed .= 'Data: '.(count($caller['args']) ? print_r($caller['args'],true) : ''.PHP_EOL);
        $parsed .= 'Message: '.$message.PHP_EOL;

        return $parsed;
    }
}