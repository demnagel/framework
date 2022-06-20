<h1>Войти</h1>

<form id="auth"  method="post" action="/user/auth">
    <div class="login_form">
        <?= \App\Core\Cipher::csrfAtForm();?>
        <input type="email"  name="email" placeholder="email"/>
        <input type="password"  name="password" placeholder="password"/>
        <label><input name="remember" type="checkbox" checked/> запомнить</label>
        <button type="submit">войти</button>
    </div>
</form>

