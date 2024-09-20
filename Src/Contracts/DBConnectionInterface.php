<?php

namespace App\Contracts;

interface DBConnectionInterface
{
    public function connect();

    public function getConnection();
}