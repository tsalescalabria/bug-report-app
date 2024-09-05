<?php

declare(strict_types = 1);

require_once __DIR__ . '/vendor/autoload.php';

set_exception_handler([new \App\Exception\ExceptionHandler, 'handle']);

$config = \App\Helpers\Config::get('aspp');

$app = new \App\Helpers\App();
echo $app->getServerTime()->format('d-m-Y H:m:s') . PHP_EOL; 
echo $app->isDebugMode() . PHP_EOL; 
echo $app->getEnvironment() . PHP_EOL; 
echo $app->getLogPath() . PHP_EOL; 
echo $app->isRunningFromConsole() . PHP_EOL; 
