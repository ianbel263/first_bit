<div class="profile">
    <h2 class="profile__heading">Информация о пользователе:</h2>
    <table class="profile__table table">
        <?php foreach ($user_data as $key => $value) : ?>
            <tr class="table__row">
                <td class="table__col"><?= $key ?></td>
                <td class="table__col"><?= $value ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
