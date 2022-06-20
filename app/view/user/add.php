<h1>Регистрация</h1>

<form id="reg" method="post" action="/user/registration">
    <?= \App\Core\Cipher::csrfAtForm();?>
    <input name="name" placeholder="имя"/>
    <input name="email" placeholder="email"/>
    <input name="password" placeholder="password"/>
    <button type="submit">зарегистрироваться</button>
</form>