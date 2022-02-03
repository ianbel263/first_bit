'use strict';

const blogEl = document.querySelector('.blog');
if (blogEl) {

    const minimizeAllPosts = () => {
        const posts = blogEl.querySelectorAll('.post__wrap');
        posts.forEach((post) => {
           if (!post.classList.contains('post__wrap--minimized')) {
               post.classList.add('post__wrap--minimized');
           }
        });
    };

    const onPostClick = (evt) => {
        if (evt.currentTarget.classList.contains('post__wrap--minimized')) {
            minimizeAllPosts();
        }
        evt.currentTarget.classList.toggle('post__wrap--minimized');
    };

    const onEditButtonClick = (evt) => {
        const postID = evt.currentTarget.parentElement.querySelector('input[name=post_id]').value;
        window.location.href = `/personal/myblog/edit.php?post_id=${postID}`;
    };

    const addListeners = () => {
        const posts = blogEl.querySelectorAll('.post__wrap');
        posts.forEach((post) => post.addEventListener('click', onPostClick));
        const editButtons = blogEl.querySelectorAll('.post__button_edit');
        editButtons.forEach((button) => button.addEventListener('click', onEditButtonClick));
    };

    addListeners();
}
