<?php

declare(strict_types = 1);

namespace App\Helpers;

use App\Exception\NotFoundException;

Class Config {

    public static function get(String $fileName, String $key = null)
    {
        $fileContent = self::getFileContent($fileName);

        if($key == null)
        {
            return $fileContent;
        }

        return isset($fileContent[$key]) ? $fileContent[$key] : []; 
    }

    public static function getFileContent(String $fileName): array
    {
        $fileContent = [];

        try {
            $fileContent = self::searchFileByName($fileName);
        } catch(\Throwable $exception)
        {
            throw new NotFoundException(
                sprintf('The file %s.php was not found', $fileName)
            );
        }

        return $fileContent;
    }

    private static function searchFileByName($fileName)
    {
        $path = realpath(sprintf( __DIR__ . '/../Config/%s.php', $fileName));

        if(file_exists($path)){
            return require $path;
        }
    }
}