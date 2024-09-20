<?php

namespace App\Database\Connections;

use App\Contracts\DBConnectionInterface;

class PDOConnection extends AbstractConnection implements DBConnectionInterface
{

    const REQUIRED_CONNECTION_KEYS = [
        'driver',
        'host',
        'db_name',
        'db_username',
        'db_user_password',
        'default_fetch',
    ];

    public function connect(): PDOConnection
    {
        return $this;
    }

    public function getConnection()
    {

    }

    private function parseCredentials($credentials)
    {

    }
}