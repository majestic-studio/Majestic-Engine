(self.webpackChunk=self.webpackChunk||[]).push([[990],{8990:(e,c,t)=>{"use strict";t.r(c);var o=t(9669),n=t.n(o);(document.querySelector(".open_menu_background").addEventListener("click",(function(){document.querySelector("#userMenu").classList.remove("block"),document.querySelector(".open_menu_background").classList.remove("active"),document.querySelector("#drop-header-menu").classList.toggle("opened")})),document.querySelector("#drop-header-menu").addEventListener("click",(function(){document.querySelector("#userMenu").classList.toggle("block"),document.querySelector(".open_menu_background").classList.toggle("active"),document.querySelector("#drop-header-menu").classList.toggle("opened")})),null!==document.getElementById("drop-account"))&&(document.getElementById("send-account").addEventListener("click",(function(){var e=new FormData,c=document.getElementById("user").value,t=document.getElementById("password").value;e.set("user",c),e.set("password",t),n().post("/api/account/verification",e).then((function(e){})).catch((function(e){console.log(e)}))})),document.querySelector("#drop-account").addEventListener("click",(function(){document.querySelector(".account-case").classList.toggle("block")})),window.onscroll=function(){document.querySelector(".account-case").classList.remove("block")})}}]);