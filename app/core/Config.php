<?php

namespace App\Core;

use App\Core\Traits\ValidationTools;

class Config implements Interfaces\BaseStorage
{
    use ValidationTools;

    /**
     * @var array
     */
    private static $data = [];

    /**
     * @var string
     */
    private static $file = '/config.json';


    /**
     * @param $path
     * @param $assoc
     * @return void
     */
    public static function set($path, $assoc = true) : void
    {
        if (!self::$data) {
            $filePath = $path . self::$file;
            self::fileExist($filePath);
            self::$data = json_decode(file_get_contents($filePath), $assoc);
        }
    }

    /**
     * @param string $key
     * @return mixed
     */
    public static function get($key)
    {
        return isset(self::$data[$key]) ? self::$data[$key] : null;
    }
}