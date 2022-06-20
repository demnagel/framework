<?
/**
 * @param App\Model\User Object $user
 */
?>

<h1>Редактирование</h1>

<form id="update" method="post">
    <?= \App\Core\Cipher::csrfAtForm();?>
    <input name="name" placeholder="Имя" value="<?= $user->name;?>" />
    <button type="submit">Изменить</button>
</form>

<form id="del" method="post" action="/user/<?= $user->id; ?>/delete">
    <?= \App\Core\Cipher::csrfAtForm();?>
    <button type="submit">Удалить</button>
</form>

