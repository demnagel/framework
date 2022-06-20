<?

namespace App\Core\Interfaces;


interface Answer
{
    /**
     * @param \App\Core\Controller $controller
     * @return void
     */
    public static function start(\App\Core\Controller $controller);

    /**
     * @param $data
     * @return void
     */
    public static function json($data);

    /**
     * @param $path
     * @return void
     */
    public static function redirect($path);
}