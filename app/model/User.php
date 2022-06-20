<?php

namespace App\Model;

use App\Core\Cipher;
use \Illuminate\Database\Eloquent\Model;

class User extends Model implements \App\Core\Interfaces\Auth
{
    public $timestamps = false;
    protected $guarded = [];

    /**
     * @var string
     */
    protected $adminGroup = 'admin';

    /**
     * @var bool
     */
    protected $isAdmin = false;

    /**
     * @var bool
     */
    protected $isAuth = false;

    /**
     * @var array
     */
    protected $groups = [];


    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    /**
     * @return bool
     */
    public function isAuth(): bool
    {
        return $this->isAuth;
    }

    /**
     * @return array
     */
    public function getGroups(): array
    {
        return $this->groups;
    }


    /**
     * @return void
     */
    public static function logOut(): void
    {
        Cipher::unsetSessionToken();
        Cipher::unsetCookieToken();
    }

    /**
     * @param $email
     * @param $password
     * @param string $remember
     * @return array
     */
    public static function logIn($email, $password, $remember = ''): array
    {
        $result = ['status' => false];

        if ($email && $password) {
            if ($user = User::where([['email', $email], ['active', true]])->first()) {
                Cipher::setSessionToken($user->token);
                if ($result['status'] = password_verify($password, $user->password)) {
                    if ($remember) {
                        Cipher::setCookieToken($user->token);
                    }
                } else {
                    $result['error'] = 'Не верный логин/пароль';
                }
            } else {
                $result['error'] = 'Пользователь не существует';
            }
        }
        return $result;
    }


    /**
     * @return User
     */
    public static function current(): User
    {
        if ($token = Cipher::searchAndCheckToken()) {
            $user = self::where('token', $token)->first();
            if ($user) {
                $user->isAuth = true;
                $user->groups = $groups = Right::join('groups', 'rights.group_id', '=', 'groups.id')
                    ->where('rights.user_id', $user->id)
                    ->pluck('groups.role')
                    ->toArray();
                if (in_array($user->adminGroup, $groups)) {
                    $user->isAdmin = true;
                }
                return $user;
            }
        }
        return new self();
    }

    /**
     * @param array $userParams
     * @return array
     */
    public static function addNew(array $userParams): array
    {
        $result = ['status' => false];

        if ($userParams['email'] && !self::where('email', $userParams['email'])->count()) {
            $userParams['password'] = Cipher::password($userParams['password']);
            $userParams['token'] = Cipher::token($userParams['email'], $userParams['password']);
            $data = self::create($userParams);
            if ($data->id) {
                $result['status'] = true;
                $result['id'] = $data->id;
                Cipher::setSessionToken($userParams['token']);
            } else {
                $result['error'] = 'Не получилось создать';
            }
        } else {
            $result['error'] = 'Пользователь с таким email уже существует!';
        }

        return $result;
    }

}
