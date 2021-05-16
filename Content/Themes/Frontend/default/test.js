

var btn_header = document.querySelector('#drop-header-menu');
var menu = document.querySelector('.dhm');

btn_header.addEventListener('click', function () {
    document.querySelector('.dhm').classList.toggle('block');
});