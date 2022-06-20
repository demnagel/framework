<?

namespace App\Core\Interfaces;


interface UserSafety
{
    /**
     * @param $csrf
     * @return mixed
     */
    public static function verificationCsrf($csrf);

    /**
     * @param $email
     * @param $password
     * @return mixed
     */
    public static function token($email, $password);

    /**
     * @param $password
     * @return mixed
     */
    public static function password($password);

    /**
     * @param $token
     * @return mixed
     */
    public static function visitorToken($token);

    /**
     * @return void
     */
    public static function setCsrf();

    /**
     * @return mixed
     */
    public static function searchAndCheckToken();
}