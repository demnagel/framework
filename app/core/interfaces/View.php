<?php

namespace App\Core\Interfaces;

interface View
{
    /**
     * @param $view
     * @param array $params
     * @return void
     */
    public static function render($view, $params = []);

    /**
     * @param $path
     * @param array $params
     * @param array $excludedPath
     * @return void
     */
    public static function renderFile($path, $params = [], $excludedPath = []);
}