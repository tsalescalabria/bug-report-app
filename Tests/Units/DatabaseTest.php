<?php

namespace Tests\Units;

use PHPUnit\Framework\TestCase;
use App\Database\Connections\MySQLConnection;
use App\Database\Connections\PDOConnection;
use App\Contracts\DBConnectionInterface;
use App\Exception\MissingArgumentException;
use App\Helpers\Config;

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
    
    public function testItCanConnectToDatabaseWithPdoApi(): PDOConnection
    {
        $credentials = $this->getCredentials('pdo');
        $PDOHandler =  (new PDOConnection($credentials))->connect();
        self::assertNotNull($PDOHandler);
        self::assertInstanceOf(DBConnectionInterface::class, $PDOHandler);

        return $PDOHandler;
    }

    /** @depends testItCanConnectToDatabaseWithPdoApi */
    public function testItIsAValidPdoConnection(DBConnectionInterface $handler): void
    {
        self::assertInstanceOf(\PDO::class, $handler->getConnection());
    }

    public function testItThrowsMissingArgumentExceptionWithWrongCredentialKeys(): void
    {
        self::expectException(MissingArgumentException::class);
        $credentials = [];
        $PDOHandler =  new PDOConnection($credentials);
    }

    private function getCredentials(string $type): array
    {
        return array_merge(
            Config::get('database', $type),
            ['db_name' => 'bug_app_testing']
        );
    }
}