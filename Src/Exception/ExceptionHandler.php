<?php

namespace App\Exception;

use Throwable;
use App\Helpers\App;
use App\Exception\ErrorMessage;

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

    public function convertWarningsAndNoticesToException(){
        
    }
}