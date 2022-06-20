<?php

namespace App\Core;


final class Router implements Interfaces\Singleton, Interfaces\Router
{
    use Traits\Singleton;

    /**
     * @var string
     */
    private $pattern = '/^\{([a-z]+)\}$/';

    /**
     * @var array
     */
    private $controllers = [];


    /**
     * @param $path
     * @param $controller
     * @return void
     */
    public function get($path, $controller): void
    {
        $this->controllers['get'][$path] = $controller;
    }

    /**
     * @param $path
     * @param $controller
     * @return void
     */
    public function post($path, $controller): void
    {
        $this->controllers['post'][$path] = $controller;
    }


    /**
     * @param $path
     * @param $controllers
     * @return array
     */
    private function deepRouteSearch($path, $controllers): array
    {
        $result = [];
        $arrPath = explode('/', $path);

        foreach (array_keys($controllers) as $val) {
            $arrValPath = explode('/', $val);
            if (count($arrValPath) == count($arrPath)) {

                $checkResult = [];
                $etalon = $arrPath;
                $etalonPath = $arrValPath;
                $pattern = [];

                foreach ($arrValPath as $i => $word) {
                    preg_match($this->pattern, $word, $matches);
                    if ($matches) {
                        $pattern[] = $matches[0];
                        $checkResult[$matches[1]] = $arrPath[$i];
                        unset($etalonPath[$i]);
                        unset($etalon[$i]);
                    }
                }

                if ($etalon == $etalonPath) {

                    $result = [
                        'controller' => $controllers[$val],
                        'params' => $checkResult,
                        'rout' => [
                            'path' => $val,
                            'var' => $pattern
                        ]
                    ];
                }
            }
        }

        return $result;
    }


    /**
     * @param $path
     * @param $controllers
     * @return array
     */
    private function routeSearch($path, $controllers): array
    {
        if (array_key_exists($path, $controllers) && $controllers[$path]) {
            $result['controller'] = $controllers[$path];
        } else {
            $result = $this->deepRouteSearch($path, $controllers);
        }

        return $result;
    }


    /**
     * @return void
     */
    public function start(): void
    {
        $routeData = $this->routeSearch(
            Storage::get('request')->path(),
            $this->controllers[Storage::get('request')->method()]
        );

        if ($routeData['controller'] && class_exists($routeData['controller'])) {
            Answer::start(new $routeData['controller']($routeData));
        } else {
            \App\Core\Controller::actionError('404');
        }
    }
}