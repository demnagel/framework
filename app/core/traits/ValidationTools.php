<?php

namespace App\Core\Traits;

trait ValidationTools
{
    /**
     * @param array $array
     * @return array
     */
    public static function validateStringValuesForArr(array $array): array
    {
        foreach ($array as &$val) {
            $val = trim(strip_tags($val));
        }
        return $array;
    }

    /**
     * @param $filePath
     * @return bool
     * @throws \Exception
     */
    public static function fileExist($filePath)
    {
        if (file_exists($filePath)) {
            return true;
        } else {
            throw new \Exception('Ошибка: Файл ' . $filePath . ' не найден.');
        }
    }
}