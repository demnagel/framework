<?php

namespace App\Core;

class Cipher implements Interfaces\UserSafety, Interfaces\TokenManagement
{

    const KEY = 'id';
    const DELIMITER = '|';
    const DAYS = 30;
    const CSRF_KEY = 'csrf';

    /**
     * @return void
     */
    public static function setCsrf(): void
    {
        if (!$_SESSION[self::CSRF_KEY]) {
            $_SESSION[self::CSRF_KEY] = md5(uniqid());
        }
    }

    /**
     * @return string
     */
    public static function csrfAtForm(): string
    {
        $res = '';
        if ($_SESSION[self::CSRF_KEY]) {
            $res = '<input hidden type="text" name="csrf" value="' . $_SESSION[self::CSRF_KEY] . '"/>';
        }
        return $res;
    }

    /**
     * @return string
     */
    public static function getCsrf(): string
    {
        return $_SESSION[self::CSRF_KEY] ?? '';
    }

    /**
     * @param $csrf
     * @return bool
     */
    public static function verificationCsrf($csrf): bool
    {
        return $csrf === self::getCsrf() ? true : false;
    }

    /**
     * @param $email
     * @param $password
     * @return string
     */
    public static function token($email, $password): string
    {
        return password_hash($email . time() . $password, PASSWORD_BCRYPT);
    }

    /**
     * @param $password
     * @return string
     */
    public static function password($password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @param $token
     * @return string
     */
    public static function visitorToken($token): string
    {
        return $token . self::DELIMITER . md5($_SERVER['HTTP_USER_AGENT']);
    }

    /**
     * @param $token
     * @return void
     */
    public static function setSessionToken($token): void
    {
        $_SESSION[self::KEY] = self::visitorToken($token);
    }

    /**
     * @return void
     */
    public static function unsetSessionToken(): void
    {
        unset($_SESSION[self::KEY]);
    }

    /**
     * @param $token
     */
    public static function setCookieToken($token): void
    {
        setcookie(self::KEY, self::visitorToken($token), strtotime('+' . self::DAYS . ' days'), "/");

    }

    /**
     * @return void
     */
    public static function unsetCookieToken(): void
    {
        if ($_COOKIE[self::KEY]) {
            setcookie(self::KEY, '', strtotime('-' . self::DAYS . ' days'), "/");
        }
    }

    /**
     * @return string
     */
    public static function searchAndCheckToken(): string
    {
        if ($_SESSION[self::KEY]) {
            $hash = $_SESSION[self::KEY];
        } elseif ($_COOKIE[self::KEY]) {
            $hash = $_COOKIE[self::KEY];
        } else {
            $hash = '';
        }

        if ($hash) {
            $data = explode(self::DELIMITER, $hash);
            $curUserAgent = md5($_SERVER['HTTP_USER_AGENT']);
            if ($data[1] == $curUserAgent) {
                return $data[0];
            }
        }

        return '';
    }

}