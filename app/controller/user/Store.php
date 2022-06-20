<?php
namespace App\Controller\User;

use App\Core\Controller;
use App\Core\Storage;
use App\Model\User;

class Store extends Controller
{
    protected $csrf = true;
    public $json = true;

    public function action() : array
    {
        $userParams = Storage::get('request')->post();
        return User::addNew([
            'name' => $userParams['name'],
            'email' => $userParams['email'],
            'password' => $userParams['password'],
        ]);
    }
}
