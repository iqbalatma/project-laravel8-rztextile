$(document).ready((function(){$("#segmentation_id").on("change",(function(){var o=$(this).val();$.ajax({method:"GET",url:"/ajax/promotion-messages/customer-segmentations/".concat(o)}).done((function(o){var e=o.data;e.length>0?($("#blast-promotion-message-container").removeClass("d-none"),$("#promotion-blast").append("<option selected disabled>Select Promotion Message Bellow</option>"),e.forEach((function(o){$("#promotion-blast").append('<option value="'.concat(o.id,'" data-message="').concat(o.message,'">').concat(o.name,"</option>"))}))):($("#blast-promotion-message-container").addClass("d-none"),$("#promotion-blast").empty())})).fail()})),$(".promotion").on("change",(function(){var o=$("option:selected",this).data("message");$(".message").html(o),$(".message-input").val(o)}))}));