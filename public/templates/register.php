<div class="form form--register" id="register_form">
    <form class="row" action="" method="post">
        <h1 class="form__heading">Регистрация</h1>
        <div class="form__item col-md-6 <?= isset($errors['username']) ? "form__item--invalid" : ""; ?>">
            <label for="username">Логин<sup>*</sup></label>
            <input id="username" type="text" name="username" value="<?= get_post_value('username'); ?>"
                   placeholder="Введите логин" autofocus>
            <span class="form__error"><?= array_key_exists('username', $errors) ? $errors['username'] : '' ?></span>
        </div>
        <div class="form__item col-md-6 <?= isset($errors['nickname']) ? "form__item--invalid" : ""; ?>">
            <label for="nickname">Никнэйм<sup>*</sup></label>
            <input id="nickname" type="text" name="nickname" value="<?= get_post_value('nickname'); ?>"
                   placeholder="Введите никнэйм">
            <span class="form__error"><?= array_key_exists('nickname', $errors) ? $errors['nickname'] : '' ?></span>
        </div>
        <div class="form__item col-md-4 <?= isset($errors['last_name']) ? "form__item--invalid" : ""; ?>">
            <label for="last_name">Фамилия<sup>*</sup></label>
            <input id="last_name" type="text" name="last_name" value="<?= get_post_value('last_name'); ?>"
                   placeholder="Введите фамилию">
            <span class="form__error"><?= array_key_exists('last_name', $errors) ? $errors['last_name'] : '' ?></span>
        </div>
        <div class="form__item col-md-4 <?= isset($errors['first_name']) ? "form__item--invalid" : ""; ?>">
            <label for="first_name">Имя<sup>*</sup></label>
            <input id="first_name" type="text" name="first_name" value="<?= get_post_value('first_name'); ?>"
                   placeholder="Введите имя">
            <span class="form__error"><?= array_key_exists('first_name', $errors) ? $errors['first_name'] : '' ?></span>
        </div>
        <div class="form__item col-md-4">
            <label for="middle_name">Отчество</label>
            <input id="middle_name" type="text" name="middle_name" value="<?= get_post_value('middle_name'); ?>"
                   placeholder="Введите отчество">
            <span class="form__error"></span>
        </div>
        <div class="form__item col-md-6">
            <label for="email">Email</label>
            <input id="email" type="text" name="email" value="<?= get_post_value('email'); ?>"
                   placeholder="Введите логин" autofocus>
            <span class="form__error"></span>
        </div>
        <div class="form__item col-md-6">
            <label for="phone">Телефон</label>
            <input id="phone" type="text" name="phone" value="<?= get_post_value('phone'); ?>"
                   placeholder="Введите никнэйм">
            <span class="form__error"></span>
        </div>
        <div class="form__item col-md-6 <?= isset($errors['password']) ? "form__item--invalid" : ""; ?>">
            <label for="password">Пароль<sup>*</sup></label>
            <input id="password" type="password" name="password" placeholder="Введите пароль">
            <span class="form__error"><?= array_key_exists('password', $errors) ? $errors['password'] : '' ?></span>
        </div>
        <div class="form__item col-md-6 <?= isset($errors['password2']) ? "form__item--invalid" : ""; ?>">
            <label for="password2">Пароль<sup>*</sup></label>
            <input id="password2" type="password" name="password2" placeholder="Подтвердите пароль">
            <span class="form__error"><?= array_key_exists('password2', $errors) ? $errors['password2'] : '' ?></span>
        </div>
        <button id="btn" class="form__button" type="submit">Зарегистрироваться</button>
    </form>
</div>
