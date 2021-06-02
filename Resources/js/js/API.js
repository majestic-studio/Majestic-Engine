import axios from 'axios'


const authButton = document.getElementById('send-account');
authButton.addEventListener("click", function (){
    let data = new FormData();
    let user = document.getElementById('user').value
    let password = document.getElementById('password').value
    data.set('user', user)
    data.set('password', password)

    axios.post('/api/account/verification', data)
        .then(response => {

        })
        .catch(function (response) {
            console.log(response);
        });
    });
