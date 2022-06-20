<?php
namespace App\Controller\User;

use App\Core\Controller;
use App\Model\User;

class Delete extends Controller
{
    protected $rights = ['admin'];
    protected $csrf = true;
    public $json = true;

    public function action(): array
    {
        $data = $this->getRoutData();
        $result['status'] = User::where('id', '=', $data['params']['id'])->delete();
        return $result;
    }
}