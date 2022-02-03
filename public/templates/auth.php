<div class="welcome" hidden>
    <p class="welcome__text"></p>
</div>
<div class="form" id="auth_form">
    <form action="" method="post">
        <h2 class="form__heading">Авторизация</h2>
        <div class="form__item">
            <label for="username">Логин<sup>*</sup></label>
            <input id="username" type="text" name="username" value=""
                   placeholder="Введите логин" autofocus>
            <span class="form__error"></span>
        </div>
        <div class="form__item">
            <label for="password">Пароль<sup>*</sup></label>
            <input id="password" type="password" name="password" placeholder="Введите пароль">
            <span class="form__error"></span>
        </div>
        <button id="btn" class="form__button" type="submit">Войти</button>
    </form>
</div>
