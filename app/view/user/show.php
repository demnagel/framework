<?
/**
 * @param App\Model\User Object $user
 * @param array $params
 */
?>

<h1>Пользователь</h1>
<div>
    <div>Имя: <?= $user->name;?></div>
    <div>Email: <?= $user->email;?></div>
    <a href="/user/<?= $user->id; ?>/update">Редактировать</a>
</div>
