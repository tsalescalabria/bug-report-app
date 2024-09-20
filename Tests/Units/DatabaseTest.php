<?php

namespace Tests\Units;

use PHPUnit\Framework\TestCase;
use App\Database\Connections\MySQLConnection;
use App\Database\Connections\PDOConnection;
use App\Contracts\DBConnectionInterface;

class DatabaseTest extends TestCase
{

    private $mySql;
    private $PDO;

    // protected function SetUp(): void
    // {
    //     $this->mySql = new MySQLConnection();
    // }

    // //mysqli tests
    // public function testMySQLConnectionImplementsInterface(): void
    // {
    //     self::assertInstanceOf(DBConnectionInterface::class, $this->mySql);
    // }

    // public function testItCanConnectToDatabaseWithMysqli(): void
    // {
    //     self::assertNotFalse($this->mySql->getConnection());
    //     self::assertFalse($this->mySql->connection_error);
    // }

    //pdo tests
    public function testPDOConnectionImplementsInterface(): void
    {
        $credentials = [];
        self::assertInstanceOf(DBConnectionInterface::class, new PDOConnection($credentials));
    }

    public function testItCanConnectToDatabaseWithPdoApi(): void
    {
        $credentials = [];
        $PDOHandler =  (new PDOConnection($credentials))->connect();
        // self::assertNotNull($this->PDO->getConnection());
    }

    public function testItThrowsMissingArgumentExceptionWithWrongCredentialKeys(): void
    {
        $credentials = [];
        $PDOHandler =  (new PDOConnection($credentials))->connect();
        // self::assertNotNull($this->PDO->getConnection());
    }
}