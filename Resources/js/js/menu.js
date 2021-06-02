import axios from 'axios'

document.querySelector('.open_menu_background').addEventListener('click', function () {
    document.querySelector('#userMenu').classList.remove('block')
    document.querySelector('.open_menu_background').classList.remove('active')
    document.querySelector('#drop-header-menu').classList.toggle('opened')
})


document.querySelector('#drop-header-menu').addEventListener('click', function () {
    function mask() {
        document.getElementById('mask-menu').classList.toggle('mask-display')
    }

    document.querySelector('#userMenu').classList.toggle('block');
    document.querySelector('.open_menu_background').classList.toggle('active')
    document.querySelector('#drop-header-menu').classList.toggle('opened')
    mask()
    setTimeout(mask, 200)
})

if(document.getElementById('drop-account') !== null) {

    let authButton = document.getElementById('send-account');
    authButton.addEventListener("click", function (){
        let data = new FormData();
        let user = document.getElementById('user').value
        let password = document.getElementById('password').value
        data.set('user', user)
        data.set('password', password)

        axios.post('/api/account/verification', data)
            .then(response => {
                const data = response.data.result

                if(data !== null) {
                    if(data.auth === true) {
                        const store = data.store

                        document.getElementById('login-message').innerHTML = data.body

                        localStorage.setItem('user', store.user)
                        localStorage.setItem('date', store.date)
                        localStorage.setItem('ip', store.ip)
                        localStorage.setItem('token', store.token)

                        setTimeout(window.location.reload(), 7000)
                    } else {
                        document.getElementById('login-message').innerHTML = data.body
                    }
                }
            });
    });
    document.querySelector('#drop-account').addEventListener('click', function () {
        document.querySelector('.account-case').classList.toggle('block')
    })

    window.onscroll = function () {
        document.querySelector('.account-case').classList.remove('block')
    }
}