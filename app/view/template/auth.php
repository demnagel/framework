<? if (\App\Core\Storage::get('user')->isAuth()): ?>
    <div>
        <div>
            <p>Вы вошли как: <?= \App\Core\Storage::get('user')->name; ?></p>
        </div>
        <form method="post" action="/user/exit">
            <button type="submit">выйти</button>
        </form>
    </div>
<? else:?>
    <div>
        <a href="/user/login">Войдите</a> или <a href="/user/registration">зарегистрируйтесь</a>
    </div>
<?endif;?>