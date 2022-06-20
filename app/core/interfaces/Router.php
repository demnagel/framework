<?

namespace App\Core\Interfaces;

interface Router
{
    /**
     * @param $path
     * @param $controller
     * @return mixed
     */
    public function get($path, $controller);

    /**
     * @param $path
     * @param $controller
     * @return mixed
     */
    public function post($path, $controller);

    /**
     * @return void
     */
    public function start();

}