<?php

class Exception400 extends Exception
{
    // Redefine the exception so message isn't optional
    public function __construct($message = "Bad Request", $code = 400, Throwable $previous = null)
    {
        // some code

        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function get_headers()
    {
        return array('Content-Type: application/json', 'HTTP/1.1 400 Bad Request');
    }
}
