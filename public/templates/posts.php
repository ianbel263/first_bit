<section class="blog">
    <ul class="blog__list">
        <?php foreach ($posts as $post) : ?>
            <li class="blog__item post">
                <?php if ($is_auth) : ?>
                    <button type="button" class="post__button_edit btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-pen" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"></path>
                        </svg>
                    </button>
                <?php endif; ?>
                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                <div class="post__wrap post__wrap--minimized row g-0 rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="post__author d-inline-block mb-2 text-success"><?= $post['nickname'] ?></strong>
                        <h3 class="post__heading mb-0"><?= $post['heading'] ?></h3>
                        <div class="post__date mb-1 text-muted"><?= $post['created_at'] ?></div>
                        <p class="post__text mb-auto"><?= $post['body'] ?></p>
                    </div>
                    <?php if ($post['image_url']) : ?>
                        <div class="post__image col-auto d-none d-lg-block">
                            <img width="200" height="250"
                                 src="<?= $post['image_url'] ?>" alt="">
                        </div>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>