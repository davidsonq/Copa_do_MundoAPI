<?php

namespace App\Exceptions;

use Exception;
use DateTime;

class InvalidYearCupException extends Exception
{
    protected $message = 'there was no world cup this year';
    public function __construct(){
        parent::__construct($this->message, 400);
    }
}
