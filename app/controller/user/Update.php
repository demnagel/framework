<?php
namespace App\Controller\User;

use App\Core\Controller;
use App\Core\Storage;
use App\Model\User;

class Update extends Controller
{
    protected $rights = ['admin'];
    protected $csrf = true;
    public $json = true;

    public function action() : array
    {
        $userParams = Storage::get('request')->post();
        $data = $this->getRoutData();
        $result['status'] = User::where('id', '=', $data['params']['id'])->update(['name' => $userParams['name']]);
        return $result;
    }
}
