<?php
namespace App\Controller\User;

use App\Core\Controller;
use App\Core\Storage;
use App\Model\User;


class Auth extends Controller
{
    protected $csrf = true;
    public $json = true;

    public function action() : array
    {
        $authData = Storage::get('request')->post();
        return User::logIn($authData['email'], $authData['password'], $authData['remember']);
    }
}