<?php

namespace App\Exceptions;

use Exception;

class ImpossibleTitlesException extends Exception
{
    protected $message = 'impossible to have more titles than disputed cups';

    public function __construct(){
        parent::__construct($this->message, 400);
    }
}
