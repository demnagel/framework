<?

namespace App\Core\Interfaces;

use App\Core\Request;
use App\Model\User;

interface Controller
{
    /**
     * @return array
     */
    public function getRoutData(): array;

    /**
     * @param Request $request
     * @return bool
     */
    public function checkCsrf(Request $request): bool;

    /**
     * @param User $user
     * @return bool
     */
    public function checkRight(User $user): bool;

    /**
     * @param string $view
     * @return void
     */
    public static function actionError(string $view);

    /**
     * @return void
     */
    public function action();

}