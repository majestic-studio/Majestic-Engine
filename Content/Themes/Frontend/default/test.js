const btn_header = document.querySelector('#drop-header-menu')
const menu = document.querySelector('.global-menu')
const menu_bg = document.querySelector('.open_menu_background')
const menu_btn = document.querySelector('#drop-header-menu')


btn_header.addEventListener('click', function () {
    document.querySelector('#userMenu').classList.toggle('block');
    document.querySelector('.open_menu_background').classList.toggle('active')
})

menu_bg.addEventListener('click', function () {
    document.querySelector('#userMenu').classList.remove('block')
    document.querySelector('.open_menu_background').classList.remove('active')
})

menu_btn.addEventListener('click', () => {
    document.querySelector('#drop-header-menu').classList.toggle('opened')

})



