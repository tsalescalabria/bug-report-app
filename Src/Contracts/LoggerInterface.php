<?php 

namespace App\Contracts;

interface LoggerInterface
{

    public function emergency(String $message, Array $context = []);
    public function alert(String $message, Array $context = []);
    public function critical(String $message, Array $context = []);
    public function error(String $message, Array $context = []);
    public function warning(String $message, Array $context = []);
    public function notice(String $message, Array $context = []);
    public function info(String $message, Array $context = []);
    public function debug(String $message, Array $context = []);
    public function log(String $level, String $message, Array $context = []);
    

}