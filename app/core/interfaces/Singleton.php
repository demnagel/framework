<?

namespace App\Core\Interfaces;

interface Singleton
{
    /**
     * @return mixed
     */
    public static function getInstance();
}