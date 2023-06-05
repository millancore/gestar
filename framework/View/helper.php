<?php

use Framework\View\View;

if(!function_exists('vx_slot')) {
    function vx_slot()
    {
        return View::slot();
    }
}

if (!function_exists('vx_start')) {

    function vx_start(string $path, array $params = [])
    {
        View::start($path, $params);
    }
}

if (!function_exists('vx_end')) {

    function vx_end()
    {
        View::end();
    }
}

if (!function_exists('vx_filter')) {

    function vx_filter($value, string $filterName)
    {
        return View::filter($value, $filterName);
    }
}
