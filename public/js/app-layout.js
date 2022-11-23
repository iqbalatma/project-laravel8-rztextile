/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/js/application/app-layout.js ***!
  \************************************************/
$(document).ready(function () {
  var sidebarMenu = $("#sidebar-menu a");
  var currentUrl = location.href.split('?')[0];
  sidebarMenu.each(function () {
    var sidebarUrl = $(this).attr("href");
    if (sidebarUrl === currentUrl) {
      $(this).addClass("active");
    }
  });
});
/******/ })()
;