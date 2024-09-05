<?php

declare(strict_types = 1);

namespace App\Helpers;

use DateTime, DateTimeZone, DateTimeInterface;

Class App
{
    private $config = [];

    public function __construct()
    {
        $this->config = Config::get('app');
    }

    public function isDebugMode(): bool
    {
        if(isset($this->config['debug'])){
            return $this->config['debug'];
        }
        
        return false;
    }

    public function getEnvironment(): string
    {
        if(isset($this->config['env'])){
            return $this->config['env'];
        }

        return 'production';
    }

    public function getLogPath(): string
    {
        if(isset($this->config['log_path'])){
            return $this->config['log_path'];
        }

        throw new \Exception('Log path is not defined');
    }

    public function isRunningFromConsole(): bool
    {
            return php_sapi_name() == 'cli'|| php_sapi_name() == 'phpbg';
    }

    public function getServerTime(): DateTimeInterface
    {
        return new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
    }
}