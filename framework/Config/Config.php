<?php

namespace Framework\Config;

use Exception;
use Framework\Exception\ConfigException;

class Config
{
    /**
     * Load variables from .env
     * @throws Exception
     */
    public static function load(string $path): void
    {
        if (!file_exists($path)) {
            throw new ConfigException("File $path not found");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $parts = explode('=', $line);

            if (count($parts) === 2) {
                $_ENV[$parts[0]] = trim($parts[1]);
            }
        }
    }

}