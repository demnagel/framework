<?

namespace App\Core\Interfaces;


interface TokenManagement
{
    /**
     * @param $token
     * @return void
     */
    public static function setSessionToken($token);

    /**
     * @return void
     */
    public static function unsetSessionToken();

    /**
     * @param $token
     * @return void
     */
    public static function setCookieToken($token);

    /**
     * @return void
     */
    public static function unsetCookieToken();
}