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
    const username = evt.target.querySelector('#username').value;
    const password = evt.target.querySelector('#password').value;
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
        .then((response) => response.text())
        .then((html) => {
            document.body.innerHTML = html;
            addAuthFormListener();
        })
        .catch((error) => {
            console.log(error)
        });
};

const addAuthFormListener = () => {
    const authForm = document.querySelector('#auth_form');
    authForm.addEventListener('submit', onAuthFormSubmit);
}

addAuthFormListener();
