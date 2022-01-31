<a href="index.php">Главная</a>
<?php if ($user) : ?>
    <p>Добро пожаловать, <?= $user ?></p>
<?php else : ?>
<div class="form">
    <form action="backend.php" method="post">
        <h1 class="form__heading">Авторизация</h1>
        <div class="form__item <?= isset($errors['username']) ? "form__item--invalid" : ""; ?>">
            <label for="username">Логин<sup>*</sup></label>
            <input id="username" type="text" name="username" value="<?= get_post_value('username'); ?>"
                   placeholder="Введите логин" autofocus>
            <span class="form__error"><?= array_key_exists('username', $errors) ? $errors['username'] : '' ?></span>
        </div>
        <div class="form__item <?= isset($errors['password']) ? "form__item--invalid" : ""; ?>">
            <label for="password">Пароль<sup>*</sup></label>
            <input id="password" type="password" name="password" placeholder="Введите пароль">
            <span class="form__error"><?= array_key_exists('password', $errors) ? $errors['password'] : '' ?></span>
        </div>
        <button class="form__button" type="submit">Войти</button>
    </form>
</div>
<?php endif; ?>
