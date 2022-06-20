<?php
namespace App\Controller\User;

use App\Core\Controller;
use App\Model\User;

class UnLogin extends Controller
{
    public function action() : array
    {
        User::logOut();
        $this->redirect = '/';
        return [];
    }
}
