$(document).ready((function(){$("#segmentation_id").on("change",(function(){var e=$(this).val();console.log("tes"),$.ajax({method:"GET",url:"/ajax/promotion-messages/customer-segmentations/".concat(e)}).done((function(e){var o=e.data;console.log(o),$(".message").html(o.message),$(".message-input").val(o.message),$("#discount-promo").text("Promo Discount "+o.discount+"%"),$("#blast-promotion-message-container").removeClass("d-none")})).fail()})),$(".promotion").on("change",(function(){var e=$("option:selected",this).data("message");$(".message").html(e),$(".message-input").val(e)}))}));