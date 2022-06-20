<?

namespace App\Core\Interfaces;

interface RequestParams
{
    /**
     * @return mixed
     */
    public function get();

    /**
     * @return mixed
     */
    public function post();

    /**
     * @return mixed
     */
    public function method();

    /**
     * @return mixed
     */
    public function files();

    /**
     * @return mixed
     */
    public function path();

    /**
     * @return mixed
     */
    public function root();

    /**
     * @return mixed
     */
    public function verifiedCsrf();

    /**
     * @return mixed
     */
    public function serverPath();

}