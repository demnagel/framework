<?php

namespace App\Core\Interfaces;

interface BaseStorage
{
    /**
     * @param $key
     * @param $value
     * @return void
     */
    public static function set($key, $value);

    /**
     * @param $key
     * @return mixed
     */
    public static function get($key);
}