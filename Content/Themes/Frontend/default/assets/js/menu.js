/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/menu.js ***!
  \******************************/
document.querySelector('.open_menu_background').addEventListener('click', function () {
  document.querySelector('#userMenu').classList.remove('block');
  document.querySelector('.open_menu_background').classList.remove('active');
  document.querySelector('#drop-header-menu').classList.toggle('opened');
});
document.querySelector('#drop-header-menu').addEventListener('click', function () {
  document.querySelector('#userMenu').classList.toggle('block');
  document.querySelector('.open_menu_background').classList.toggle('active');
  document.querySelector('#drop-header-menu').classList.toggle('opened');
});
/******/ })()
;