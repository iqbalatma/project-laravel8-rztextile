/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************************!*\
  !*** ./resources/js/pages/whatsapp-messaging/index.js ***!
  \********************************************************/
$(document).ready(function () {
  $("#segmentation_id").on("change", function () {
    var segmentationId = $(this).val();
    console.log("tes");
    $.ajax({
      method: "GET",
      url: "/ajax/promotion-messages/customer-segmentations/".concat(segmentationId)
    }).done(function (response) {
      var dataPromotionMessages = response.data;
      console.log(dataPromotionMessages);
      $(".message").html(dataPromotionMessages.message);
      $(".message-input").val(dataPromotionMessages.message);
      $("#discount-promo").text("Promo Discount " + dataPromotionMessages.discount + "%");
      $("#blast-promotion-message-container").removeClass("d-none");
      // if (dataPromotionMessages.length > 0) {
      //     $("#blast-promotion-message-container").removeClass(
      //         "d-none"
      //     );
      //     $("#promotion-blast").append(
      //         `<option selected disabled>Select Promotion Message Bellow</option>`
      //     );
      //     dataPromotionMessages.forEach((element) => {
      //         $("#promotion-blast").append(
      //             `<option value="${element.id}" data-message="${element.message}">${element.name}</option>`
      //         );
      //     });
      // } else {
      //     $("#blast-promotion-message-container").addClass("d-none");
      //     $("#promotion-blast").empty();
      // }
    }).fail();
  });
  $(".promotion").on("change", function () {
    var promotionMessage = $("option:selected", this).data("message");
    $(".message").html(promotionMessage);
    $(".message-input").val(promotionMessage);
  });
});
/******/ })()
;