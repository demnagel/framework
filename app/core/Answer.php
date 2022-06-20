<?php

namespace App\Core;


class Answer implements Interfaces\Answer
{

    /**
     * @param Controller $controller
     */
    public static function start(\App\Core\Controller $controller): void
    {
        if (!$controller->checkRight(Storage::get('user'))) {
            // Если нет прав
            self::redirect('/');
        } else {
            $data = $controller->action();
            if ($controller->json) {
                // Нужно вернуть json
                if ($controller->checkCsrf(Storage::get('request'))) {
                    // Ответ json
                    self::json($data);
                } else {
                    // Не прошел csrf
                    self::json($controller->unsuccessJson());
                }
            } elseif ($controller->dataNotFound) {
                // Если в результате выполнения action стало понятно что запрашиваемых данных нет
                $controller::actionError('404');
            } elseif ($controller->redirect) {
                // Возможность в action заказать редирект
                self::redirect($controller->redirect);
            } else {
                // Рендер вида
                View::render($controller->view, $data);
            }
        }
    }

    /**
     * @param $data
     * @return void
     */
    public static function json($data): void
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE, JSON_UNESCAPED_SLASHES);
        die();
    }

    /**
     * @param $path
     * @return void
     */
    public static function redirect($path): void
    {
        header('Location: ' . Storage::get('request')->serverPath() . $path);
        die();
    }

}