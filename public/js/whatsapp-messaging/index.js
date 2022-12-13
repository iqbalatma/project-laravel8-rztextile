/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************************!*\
  !*** ./resources/js/application/whatsapp-messaging/index.js ***!
  \**************************************************************/
$(document).ready(function () {
  $("#promotion").on("change", function () {
    var promotionId = $(this).val();
    $.ajax({
      method: "GET",
      url: "/ajax/promotion-messages/".concat(promotionId)
    }).done(function (response) {
      console.log(response);
    }).fail();
    $("#message").text(promotionId);
  });
});
/******/ })()
;