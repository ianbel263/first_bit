'use strict';

const onFileSelect = (evt) => {
    const file = evt.target.files;
    const f = file[0];
    const reader = new FileReader();
    reader.onload = (function (theFile) {
        return function (e) {
            const imgEl = document.querySelector('#img_preview').querySelector('img');
            imgEl.src = e.target.result;
        };
    })(f);
    reader.readAsDataURL(f);
}

const fileInput = document.querySelector('input[id=inputGroupFile04]');
if (fileInput) {
    fileInput.addEventListener('change', onFileSelect, false);
}
