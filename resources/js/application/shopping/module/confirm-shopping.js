import helper from "../../../module/helper";

function purchase(dataSet){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }); 


  $.ajax({
    url: "/shopping/purchase",
    context: document.body,
    data: dataSet,
    method: "POST"
  }).done(function(response) {
    console.log(response);
  }).fail(function(response){
    console.log(response);
  });
}

export default {
  onClickConfirm(context){
    let dataSet = {
      customer_id : null,
      payment_type: $("#payment-type").find("option:selected").val(),
      rolls: []
    };

    let isWithCustomer = $("#is-with-customer").is(":checked");
    let selectedCustomer = $("#select-customer").find("option:selected").val();


    if(isWithCustomer && selectedCustomer!= ""){
      dataSet.customer_id = selectedCustomer;
    }

    let tableRows = $("#summary-payment-container tbody tr");

    tableRows.each(function(){
     let roll_id = $(this).find("td").eq(0).text();
     let quantity_roll = parseInt($(this).find("td").eq(3).text());
     let quantity_unit = parseInt($(this).find("td").eq(5).text());
     let sub_total = helper.formatRupiahToInt($(this).find("td").eq(7).text());

     let roll = {roll_id, quantity_roll, quantity_unit, sub_total};

     dataSet.rolls.push(roll);
    })

    purchase(dataSet);
  }
}