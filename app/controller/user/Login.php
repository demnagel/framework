<?php
namespace App\Controller\User;

use App\Core\Controller;
use App\Core\Storage;

class Login extends Controller
{

    public $view = 'user/login';

    public function action() : array
    {
        if(Storage::get('user')->isAuth()){
            $this->redirect = '/';
        }
        return [];
    }
}