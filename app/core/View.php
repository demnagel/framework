<?php

namespace App\Core;

use App\Core\Traits\ValidationTools;

class View implements Interfaces\View
{

    use ValidationTools;

    /**
     * @var string
     */
    private static $header = 'system/header';

    /**
     * @var string
     */
    private static $footer = 'system/footer';

    /**
     * @return string
     */
    private static function getDir(): string
    {
        return Storage::get('request')->root() . '/app/view';
    }

    /**
     * @param $view
     * @param array $params
     * @return string
     * @throws \Exception
     */
    private static function includeView($view, $params = []): string
    {
        $path = self::getDir() . '/' . $view . '.php';
        self::fileExist($path);
        if ($params) {
            extract($params);
        }
        ob_start();
        include($path);
        return ob_get_clean();
    }

    /**
     * @param $path
     * @param array $params
     * @param array $excludedPath
     * @return void
     */
    public static function renderFile($path, $params = [], $excludedPath = []): void
    {
        $data = self::includeView($path, $params);
        if ($excludedPath) {
            if (in_array(Storage::get('request')->path(), $excludedPath)) {
                $data = '';
            }
        }
        echo $data;
    }

    /**
     * @param $view
     * @param array $params
     * @return void
     */
    public static function render($view, $params = []): void
    {
        $content = self::includeView(self::$header);
        $content .= self::includeView($view, $params);
        $content .= self::includeView(self::$footer);
        echo $content;
    }

}