<?php

namespace Tests\Units;

use App\Logger\Logger;
use App\Logger\LogLevel;
use App\Helpers\App;
use PHPUnit\Framework\TestCase;
use App\Contracts\LoggerInterface;
use App\Exception\InvalidLogLevelArgument;

class LoggerTest extends TestCase
{

    private $logger;

    protected function setUp(): void
    {
        $this->logger = new Logger();
        parent::setUp();
    }

    public function testItImplementsLoggerInterface()
    {
        self::assertInstanceOf(LoggerInterface::class, $this->logger);
    }

    public function testItCanCreateDifferentTypesOfLogLevels()
    {
        $this->logger->info('Testing info logs');
        $this->logger->error('Testing error logs');
        $this->logger->log(LogLevel::ALERT, 'Testing alert logs');
        $app = new App;

        $filename = sprintf("%s/%s-%s.log", $app->getLogPath(), $app->getEnvironment(), date('j.n.Y'));

        self::assertFileExists($filename);

        $contentOfLogFile = file_get_contents($filename);

        self::assertStringContainsString('Testing info logs', $contentOfLogFile);
        self::assertStringContainsString('Testing error logs', $contentOfLogFile);
        self::assertStringContainsString(LogLevel::ALERT, $contentOfLogFile);

        unlink($filename);

        self::assertFileNotExists($filename);
    }

    public function testItThrowsInvalidLogLevelArgumentExceptionWhenGivenAWrongLogLevel()
    {
        self::expectException(InvalidLogLevelArgument::class);
        
        $this->logger->log('invalidLevel', 'test');
    }
}