<?php

declare(strict_types = 1);

namespace App\Exception;

use Throwable;
use App\Helpers\App;
use App\Exception\ErrorMessage;
use ErrorException;

class ExceptionHandler
{
    public function handle(Throwable $exception): void
    {
        $application = new App;

        if ($application->isDebugMode()) {
            var_dump($exception);
            exit;
        } 
        
        $errorMessage = new ErrorMessage;
        echo $errorMessage->displayMessage();
        exit;
    }

    public function convertWarningsAndNoticesToException($severity, $message, $file, $line)
    {
        throw new ErrorException($severity, $severity, $message, $file, $line);
    }
}