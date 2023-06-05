<?php

namespace Framework\View;

use Framework\View\Exception\ViewException;

/**
 * @method static void start(string $path, array $params = [])
 * @method static string render(string $path, array $params = [])
 * @method static string slot()
 * @method static string filter($value, string $filterName)
 *
 */
final class View
{
    /**
     * @throws ViewException
     */
    public static function __callStatic($name, $arguments)
    {
        $resolver = Resolver::getInstance();

        if (!method_exists($resolver, $name)) {
            throw new ViewException("Method $name not found");
        }

        return $resolver->$name(... $arguments);

    }
}