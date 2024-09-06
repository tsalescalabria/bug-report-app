<?php

declare(strict_types = 1);

namespace App\Exception;

use Exception, Throwable;

class BaseException extends Exception
{
    protected $data = []; 

    public function __construct(
        String $message = '',
        array $data = [],
        int $code = 0,
        Throwable $previous = null
        )
    {
        $this->data = $data;
        parent::__construct($message, $code, $previous);
    }

    public function setData(String $key, $value): void
    {
        $this->data['key'] = $value;
    }

    public function getExtraData(String $value): array
    {

        if(count($this->data) === 0){
            return $this->data;
        }

        return json_decode(json_encode($this->data), true);
    }
}