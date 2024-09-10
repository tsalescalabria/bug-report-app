<?php

declare(strict_types = 1);

use App\Logger\LogLevel;

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/Src/Exception/exception.php';

$logger = new \App\Logger\Logger();
$logger->log(LogLevel::EMERGENCY, 'no level test', ['exception' => 'emergency']);
$logger->log(LogLevel::INFO, 'file created');