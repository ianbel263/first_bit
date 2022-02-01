<a href="index.php">Главная</a>
<a href="private.php">Приватная</a>
<a href="logout.php">Выйти</a>

<div class="profile">
    <ul class="profile__list">
        <?php foreach ($user_data as $key => $value) : ?>
            <li class="profile__item"><?= $key ?>: <?= $value ?></li>
        <?php endforeach; ?>
    </ul>
</div>
