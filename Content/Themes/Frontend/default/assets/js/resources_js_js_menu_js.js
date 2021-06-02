(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_js_menu_js"],{

/***/ "./resources/js/js/menu.js":
/*!*********************************!*\
  !*** ./resources/js/js/menu.js ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);

document.querySelector('.open_menu_background').addEventListener('click', function () {
  document.querySelector('#userMenu').classList.remove('block');
  document.querySelector('.open_menu_background').classList.remove('active');
  document.querySelector('#drop-header-menu').classList.toggle('opened');
});
document.querySelector('#drop-header-menu').addEventListener('click', function () {
  function mask() {
    document.getElementById('mask-menu').classList.toggle('mask-display');
  }

  document.querySelector('#userMenu').classList.toggle('block');
  document.querySelector('.open_menu_background').classList.toggle('active');
  document.querySelector('#drop-header-menu').classList.toggle('opened');
  mask();
  setTimeout(mask, 200);
});

if (document.getElementById('drop-account') !== null) {
  var authButton = document.getElementById('send-account');
  authButton.addEventListener("click", function () {
    var data = new FormData();
    var user = document.getElementById('user').value;
    var password = document.getElementById('password').value;
    data.set('user', user);
    data.set('password', password);
    axios__WEBPACK_IMPORTED_MODULE_0___default().post('/api/account/verification', data).then(function (response) {
      var data = response.data.result;

      if (data !== null) {
        if (data.auth === true) {
          var store = data.store;
          document.getElementById('login-message').innerHTML = data.body;
          localStorage.setItem('user', store.user);
          localStorage.setItem('date', store.date);
          localStorage.setItem('ip', store.ip);
          localStorage.setItem('token', store.token);
          setTimeout(window.location.reload(), 7000);
        } else {
          document.getElementById('login-message').innerHTML = data.body;
        }
      }
    });
  });
  document.querySelector('#drop-account').addEventListener('click', function () {
    document.querySelector('.account-case').classList.toggle('block');
  });

  window.onscroll = function () {
    document.querySelector('.account-case').classList.remove('block');
  };
}

/***/ })

}]);