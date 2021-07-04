
const API_USUARIOS = '../app/api/usuarios.php?action=';


document.addEventListener('DOMContentLoaded', function () {

    M.Tooltip.init(document.querySelectorAll('.tooltipped'));


    fetch(API_USUARIOS + 'readAll', {
        method: 'get'
    }).then(function (request) {

        if (request.ok) {
            request.json().then(function (response) {

                if (response.status) {
                    sweetAlert(3, response.message, 'index.php');
                } else {

                    if (response.error) {
                        sweetAlert(2, response.exception, null);
                    } else {
                        sweetAlert(4, 'Debe crear un usuario para comenzar', null);
                    }
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});


document.getElementById('register-form').addEventListener('submit', function (event) {

    event.preventDefault();

    fetch(API_USUARIOS + 'register', {
        method: 'post',
        body: new FormData(document.getElementById('register-form'))   
    }).then(function (request) {

        if (request.ok) {
            request.json().then(function (response) {

                if (response.status) {
                    sweetAlert(1, response.message, 'index.php');   
                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error)
    });
});