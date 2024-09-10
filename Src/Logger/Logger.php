<?php

namespace App\Logger;

use App\Contracts\LoggerInterface;
use App\Exception\InvalidLogLevelArgument;
use App\Helpers\App;

class Logger implements LoggerInterface
{
    public function emergency(String $message, Array $context = [])
    {
        $this->addRecord(LogLevel::EMERGENCY, $message, $context);
    }

    public function alert(String $message, Array $context = [])
    {
        $this->addRecord(LogLevel::ALERT, $message, $context);
    }

    public function critical(String $message, Array $context = [])
    {
        $this->addRecord(LogLevel::CRITICAL, $message, $context);
    }

    public function error(String $message, Array $context = [])
    {
        $this->addRecord(LogLevel::ERROR, $message, $context);
    }

    public function warning(String $message, Array $context = [])
    {
        $this->addRecord(LogLevel::WARNING, $message, $context);
    }

    public function notice(String $message, Array $context = [])
    {
        $this->addRecord(LogLevel::NOTICE, $message, $context);
    }

    public function info(String $message, Array $context = [])
    {
        $this->addRecord(LogLevel::INFO, $message, $context);
    }

    public function debug(String $message, Array $context = [])
    {
        $this->addRecord(LogLevel::DEBUG, $message, $context);
    }

    public function log(String $level, String $message, Array $context = [])
    {
        $object = new \ReflectionClass(LogLevel::class);
        $validLoglevelsArray = $object->getConstants();

        if (!in_array($level, $validLoglevelsArray)) {
            throw new InvalidLogLevelArgument($level, $validLoglevelsArray);
        }

        $this->addRecord($level, $message, $context);
    }

    private function addRecord(String $level, String $message, Array $context = [])
    {
        $application = new App;
        $date = $application->getServerTime()->format('Y-m-d H:i:s');
        $env = $application->getEnvironment('');
        $logPath = $application->getLogPath('log_path');
        $details = sprintf("%s - Level: %s - Message: %s - Context: %s", $date, $level, $message, json_encode($context)) . PHP_EOL;

        $fileName = sprintf("%s/%s-%s.log", $logPath, $env, date('j.n.Y'));

        file_put_contents($fileName, $details, FILE_APPEND);
    }

}