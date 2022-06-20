<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use \App\Core\Config;
use App\Core\Request;
use \App\Core\Storage;
use \App\Core\Router;
use \App\Model\User;
use \App\Core\Cipher;
use \App\Core\Log;
use \Illuminate\Database\Capsule\Manager as Capsule;


try {
    Config::set($_SERVER['DOCUMENT_ROOT'] . '/app');
    Cipher::setCsrf();

    $capsule = new Capsule;
    $capsule->addConnection(Config::get('db'));
    $capsule->bootEloquent();

    Storage::set('router', Router::getInstance());
    Storage::set('user', User::current());
    Storage::set('request', new Request());
    Storage::set('log', new Log(Config::get('log')));

    require_once $_SERVER['DOCUMENT_ROOT'] . '/web.php';

    try {
        Storage::get('router')->start();
    } catch (\Exception $e) {
        Storage::get('log')->write($e->getMessage());
    }

} catch (Exception $e) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/app/view/system/site_error.php';
}