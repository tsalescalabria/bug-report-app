<?php

declare(strict_types = 1);

namespace App\Exception;

class ErrorMessage
{
    private string $message;   

    public function __construct()
    {
        $this->message = 'Something went wrong. Please try again later';
    }

    public function displayMessage()
    {
        return $this->message;
    }
}