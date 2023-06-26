<?php

declare(strict_types=1);

namespace Xfrmk\Config;

use Exception;
use Xfrmk\Exception\ConfigException;

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

        $envFileContent = file_get_contents($path) ?: '';
        $envVariables = array_filter((new self)->parse($envFileContent));

        // Load variables to $_ENV directly
        foreach ($envVariables as $key => $value) {
            $_ENV[$key] = $value;
        }
    }


    /**
     * Parse .env content using regex
     * @param string $data
     * @return array<string, string>
     *
     */
    public function parse(string $data) : array
    {
        $regex = '/^([a-zA-Z0-9_]+)=(.*)$/m';

        preg_match_all($regex, $data, $matches, PREG_SET_ORDER, 0);

        $env = [];

        foreach ($matches as $match) {
            $env[$match[1]] = $match[2];
        }

        return $env;

    }

}