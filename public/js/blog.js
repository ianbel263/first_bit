'use strict';

const blogEl = document.querySelector('.blog');
if (blogEl) {

    const minimizeAllPosts = () => {
        const posts = blogEl.querySelectorAll('.post');
        posts.forEach((post) => {
           if (!post.classList.contains('post--minimized')) {
               post.classList.add('post--minimized');
           }
        });
    };

    const onPostClick = (evt) => {
        if (evt.currentTarget.classList.contains('post--minimized')) {
            minimizeAllPosts();
        }
        evt.currentTarget.classList.toggle('post--minimized');
    };

    const addListeners = () => {
        const posts = blogEl.querySelectorAll('.post');
        posts.forEach((post) => post.addEventListener('click', onPostClick));
    };

    addListeners();
}
