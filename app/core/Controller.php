<?php

namespace App\Core;


use App\Core\Traits\Errors;
use App\Model\User;

abstract class Controller implements Interfaces\Controller
{

    use Errors;

    /** Нужно ли проверять csrf
     * @var bool
     */
    protected $csrf = false;

    /** Какие группы обладают правами
     * @var array
     */
    protected $rights = [];

    /** Данные которые передаются через роут
     * @var array
     */
    protected $routData = [];

    /** Флаг - данные в результате запроса не найдены
     * @var bool
     */
    public $dataNotFound = false;

    /** Ответ нужно отдать в json
     * @var bool
     */
    public $json = false;

    /** Путь к нужной view относительно /app/view без расширения
     * @var string
     */
    public $view = '';

    /** Если необходим редирект
     * @var string
     */
    public $redirect = '';


    /**
     * Controller constructor.
     * @param $routData
     */
    function __construct($routData)
    {
        $this->routData = $routData;
    }

    /**
     * @return array
     */
    public function getRoutData() : array
    {
        return $this->routData;
    }

    /**
     * @param string $view
     * @return void
     */
    public static function actionError(string $view): void
    {
        switch ($view) {
            case '404':
                header('HTTP/1.1 404 Not Found');
                header('Status: 404 Not Found');
                break;

            case '403':
                header('HTTP/1.1 403 Forbidden');
                header('Status: 403 Forbidden');
                break;

            case '500':
                header('HTTP/1.1 500 Internal Server Error');
                header('Status: 500 Internal Server Error');
                break;
        }

        View::renderFile('/system/' . $view);
        die();
    }

    /**
     * @param User $user
     * @return bool
     */
    public function checkRight(User $user): bool
    {
        if ($this->rights && !array_intersect($user->getGroups(), $this->rights)) {
            $this->addError('Нет прав');
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function checkCsrf(Request $request): bool
    {
        if ($this->csrf && !$request->verifiedCsrf()) {
            $this->addError('Не валидный csrf');
            return false;
        } else {
            return true;
        }
    }

    /**
     * @return array
     */
    abstract public function action(): array;
}