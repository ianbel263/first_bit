'use strict';

const SERVER_TIMEOUT = 15000
const RequestMethod = {
    GET: `GET`,
    POST: `POST`,
    PUT: `PUT`,
    DELETE: `DELETE`
};
const Urls = {
    AUTH: 'backend.php',
};

const AuthResult = {
    SUCCESS: 'success',
    FAILURE: 'failure'
};

const authForm = document.querySelector('#auth_form');
if (authForm) {
    const usernameInputEl = authForm.querySelector('#username');
    const passwordInputEl = authForm.querySelector('#password');
    const welcomeTextEl = document.querySelector('.welcome__text');

    const checkStatus = (response) => {
        if (response.status >= 200 && response.status < 300) {
            return response;
        } else {
            throw new Error(`${response.status}: ${response.statusText}`);
        }
    };

    const load = ({url, method = RequestMethod.GET, body = null, headers = new Headers()}) => {
        return Promise.race([
            fetch(`${url}`, {method, body, headers}),
            new Promise((resolve) => setTimeout(resolve, SERVER_TIMEOUT))
        ])
            .then(checkStatus)
            .catch((err) => {
                throw err;
            });
    };

    const onAuthFormSubmit = (evt) => {
        evt.preventDefault();
        const username = usernameInputEl.value;
        const password = passwordInputEl.value;
        const credentials = {
            username,
            password
        }
        load({
            url: Urls.AUTH,
            method: RequestMethod.POST,
            headers: new Headers({
                'Content-Type': `application/json`
            }),
            body: JSON.stringify(credentials),
        })
            .then((response) => response.json())
            .then((data) => {
                switch (data.result) {
                    case AuthResult.SUCCESS:
                        onSuccessAuth(data.data);
                        break;
                    case AuthResult.FAILURE:
                        onFailureAuth(data.errors);
                        break;
                }
            })
            .catch((error) => {
                console.log(error)
            });
    };

    const onSuccessAuth = (data) => {
        const userFullname = `${data.last_name} ${data.first_name} ${data.middle_name}`
        unMarkInvalid();
        welcomeTextEl.textContent = `Добро пожаловать, ${userFullname}!`;
        authForm.hidden = true;
        welcomeTextEl.parentElement.hidden = false;
    };

    const onFailureAuth = (errors) => {
        markAsInvalid(errors);
        passwordInputEl.value = '';
    };

    const unMarkInvalid = () => {
        const formItems = authForm.querySelectorAll('.form__item');
        formItems.forEach((item) => {
            if (item.classList.contains('form__item--invalid')) {
                item.classList.remove('form__item--invalid');
            }
            item.querySelector('.form__error').textContent = '';
        });
    };

    const markAsInvalid = (errors) => {
        unMarkInvalid(errors);
        for (let [key, value] of Object.entries(errors)) {
            const inputEl = authForm.querySelector(`input[name=${key}]`);
            const formItem = inputEl.parentElement;
            const errorMessageEl = formItem.querySelector('.form__error');
            formItem.classList.add('form__item--invalid');
            errorMessageEl.textContent = value;
        }
    };

    authForm.addEventListener('submit', onAuthFormSubmit);
}
