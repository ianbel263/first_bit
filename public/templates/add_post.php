<div class="form form--add_post" id="add_post_form">
    <form class="row" action="" method="post" enctype="multipart/form-data">
        <h2 class="form__heading">Добавление поста</h2>
        <? if ($post) : ?>
            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
        <? endif; ?>
        <div class="form__item col-md-9 themed-grid-col <?= isset($errors['heading']) ? "form__item--invalid" : ""; ?>">
            <label for="heading">Заголовок поста<sup>*</sup></label>
            <input id="heading" type="text" name="heading"
                   value="<?= $post ? $post['heading'] : get_post_value('heading'); ?>"
                   placeholder="Введите заголовок" autofocus>
            <span class="form__error"><?= array_key_exists('heading', $errors) ? $errors['heading'] : '' ?></span>
            <div class="row">
                <div class="form__item col-md-12 themed-grid-col <?= isset($errors['body']) ? "form__item--invalid" : ""; ?>">
                    <label for="body">Текст<sup>*</sup></label>
                    <textarea id="body" name="body"
                              placeholder="Введите текст"><?= $post ? $post['body'] : get_post_value('body'); ?></textarea>
                    <span class="form__error"><?= array_key_exists('body', $errors) ? $errors['body'] : '' ?></span>
                </div>
            </div>
        </div>
        <div class="form__item col-md-3 themed-grid-col">
            <div class="" id="img_preview">
                <img width="200" height="250" src="<?= $post ? $post['image_url'] : 'http://placehold.it/200x250/' ?>">
            </div>
        </div>
        <div class="form__item col-md-12 <?= isset($errors['body']) ? "form__item--invalid" : ""; ?>">
            <div class="input-group">
                <input type="file" class="form-control" id="inputGroupFile04" name="post_image"
                       aria-describedby="inputGroupFileAddon04" aria-label="Upload">
            </div>
            <span class="form__error"><?= array_key_exists('file', $errors) ? $errors['file'] : '' ?></span>
        </div>
        <button id="btn" class="form__button" type="submit">
            <? if ($post) : ?>
                Изменить
            <? else : ?>
                Добавить
            <? endif; ?>
        </button>
    </form>
</div>
