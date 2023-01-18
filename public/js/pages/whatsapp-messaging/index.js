/******/ (() => {
    // webpackBootstrap
    var __webpack_exports__ = {};
    /*!********************************************************!*\
  !*** ./resources/js/pages/whatsapp-messaging/index.js ***!
  \********************************************************/
    $(document).ready(function () {
        $("#segmentation_id").on("change", function () {
            var segmentationId = $(this).val();
            $.ajax({
                method: "GET",
                url: "/ajax/promotion-messages/customer-segmentations/".concat(
                    segmentationId
                ),
            })
                .done(function (response) {
                    var dataPromotionMessages = response.data;
                    if (dataPromotionMessages.length > 0) {
                        $("#blast-promotion-message-container").removeClass(
                            "d-none"
                        );
                        $("#promotion-blast").append(
                            "<option selected disabled>Select Promotion Message Bellow</option>"
                        );
                        dataPromotionMessages.forEach(function (element) {
                            $("#promotion-blast").append(
                                '<option value="'
                                    .concat(element.id, '" data-message="')
                                    .concat(element.message, '">')
                                    .concat(element.name, "</option>")
                            );
                        });
                    } else {
                        $("#blast-promotion-message-container").addClass(
                            "d-none"
                        );
                        $("#promotion-blast").empty();
                    }
                })
                .fail();
        });
        $(".promotion").on("change", function () {
            var promotionMessage = $("option:selected", this).data("message");
            $(".message").html(promotionMessage);
            $(".message-input").val(promotionMessage);
        });
    });
    /******/
})();
/******/ (() => {
    // webpackBootstrap
    /******/ "use strict";
    /******/
    /******/
    /******/
})();
