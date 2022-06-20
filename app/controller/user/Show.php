<?php
namespace App\Controller\User;

use App\Core\Controller;
use App\Model\User;

class Show extends Controller
{
    protected $rights = ['admin'];

    public $view = 'user/show';

    public function action(): array
    {
        $data = $this->getRoutData();
        if($data['params']['id'] && $user = User::find($data['params']['id'])){
            return compact(['user', 'params']);
        }
        else{
            $this->dataNotFound = true;
            return [];
        }
    }
}