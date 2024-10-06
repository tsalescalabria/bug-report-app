<?php

namespace App\Database\Connections;

use PDOException, PDO;
use App\Contracts\DBConnectionInterface;
use App\Exception\DatabaseConnectionException;
use App\Database\Connections\AbstractConnection;

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
        $credentials = $this->parseCredentials($this->credentials);

        try {
            $this->connection = new PDO(...$credentials);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                $this->credentials['default_fetch']
            );
        } catch(PDOException $exception){
            throw new DatabaseConnectionException($exception->getMessage());
        }

        return $this;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    protected function parseCredentials(array $credentials): array
    {
        $dsn = sprintf(
            '%s:host=%s;dbname=%s',
            $credentials['driver'],
            $credentials['host'],
            $credentials['db_name']
        );

        return [$dsn, $credentials['db_username'], $credentials['db_user_password']];
    }
}