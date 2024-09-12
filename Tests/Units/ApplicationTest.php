<?php

namespace Tests\Units;

use DateTime;
use App\Helpers\App;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    public function testItCanGetInstanceOfApplication()
    {
        self::assertInstanceOf(App::class, new App);
    }

    public function testItCanGetApplicationDataSet()
    {
        $app = new App();
        $debugMode = $app->isDebugMode();
        $environment = $app->getEnvironment();
        $logPath = $app->getLogPath();
        $serverTime = $app->getServerTime();
        $isRunningFromConsole = $app->isRunningFromConsole();

        self::assertTrue($isRunningFromConsole);
        self::assertIsBool($debugMode);
        self::assertIsString($environment);
        self::assertNotNull($logPath);
        $this->assertInstanceOf(DateTime::class, $serverTime);
    }

}