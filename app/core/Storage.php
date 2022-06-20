<?php

namespace App\Core;

class Storage implements Interfaces\BaseStorage
{

    /**
     * @var array
     */
    protected static $data = [];


    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value) : void
    {
        self::$data[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public static function get($key)
    {
        return isset(self::$data[$key]) ? self::$data[$key] : null;
    }

    /**
     * @param string $key
     * @return void
     */
    final public static function remove($key) : void
    {
        if (array_key_exists($key, self::$data)) {
            unset(self::$data[$key]);
        }
    }
}