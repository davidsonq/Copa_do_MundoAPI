<?php

namespace App\Exceptions;

use Exception;

class NegativeTitleException extends Exception
{
    protected $message = 'titles cannot be negative';

    public function __construct()
    {   
        parent::__construct($this->message, 400);
    }
}
