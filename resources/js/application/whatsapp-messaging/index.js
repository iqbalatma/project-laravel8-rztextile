$(document).ready(function () {
    $("#promotion").on("change", function () {
        const promotionId = $(this).val();

          $.ajax({
            method: "GET",
            url : `/ajax/promotion-messages/${promotionId}`
          })
            .done(function (response) {
              console.log(response);
            })
            .fail();

        $("#message").text(promotionId);
    });
});
