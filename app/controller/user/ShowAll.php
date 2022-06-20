<?php
namespace App\Controller\User;

use App\Core\Controller;
use App\Core\Storage;
use App\Model\User;

class ShowAll extends Controller
{
    protected $rights = ['admin'];
    public $view = 'user/list';

    public function action() : array
    {
        return ['users' => User::where('id', '!=', Storage::get('user')->id)->get()];
    }
}