<?

namespace App\Core\Interfaces;


interface Auth
{
    /**
     * @return void
     */
    public static function logOut();

    /**
     * @param $email
     * @param $password
     * @param string $remember
     * @return void
     */
    public static function logIn($email, $password, $remember = '');
}