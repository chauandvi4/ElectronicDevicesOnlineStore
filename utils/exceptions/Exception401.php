<?php

class Exception401 extends Exception
{
    // Redefine the exception so message isn't optional
    public function __construct($message = "Unauthorized", $code = 0, Throwable $previous = null)
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
        return array('Content-Type: application/json', 'HTTP/1.0 401 Unauthorized');
    }
}
