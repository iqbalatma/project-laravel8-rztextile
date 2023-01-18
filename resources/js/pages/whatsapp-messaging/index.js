$(document).ready(function () {
    $("#segmentation_id").on("change", function () {
        const segmentationId = $(this).val();
        $.ajax({
            method: "GET",
            url: `/ajax/promotion-messages/customer-segmentations/${segmentationId}`,
        })
            .done(function (response) {
                const dataPromotionMessages = response.data;
                if (dataPromotionMessages.length > 0) {
                    $("#blast-promotion-message-container").removeClass(
                        "d-none"
                    );
                    $("#promotion-blast").append(
                        `<option selected disabled>Select Promotion Message Bellow</option>`
                    );
                    dataPromotionMessages.forEach((element) => {
                        $("#promotion-blast").append(
                            `<option value="${element.id}" data-message="${element.message}">${element.name}</option>`
                        );
                    });
                } else {
                    $("#blast-promotion-message-container").addClass("d-none");
                    $("#promotion-blast").empty();
                }
            })
            .fail();
    });
    $(".promotion").on("change", function () {
        const promotionMessage = $("option:selected", this).data("message");

        $(".message").html(promotionMessage);
        $(".message-input").val(promotionMessage);
    });
});
