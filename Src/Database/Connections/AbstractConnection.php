<?php

namespace App\Database\Connections;

abstract class AbstractConnection
{
    private $credentials;
    private $connection;

    const REQUIRED_CONNECTION_KEYS = [];

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    private function creadentialsHasRequiredKeys($providedKeys)
    {

    }
}