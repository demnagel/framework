<?
/**
 * @param App\Model\User Object $users
 * @param array $params
 */
?>

<h1>Список пользователей</h1>

<div class="list">
<? foreach ($users as $user): ?>
    <a href="/user/<?= $user->id; ?>" class="list__item"><?= $user->name; ?></a>
<? endforeach; ?>
</div>



