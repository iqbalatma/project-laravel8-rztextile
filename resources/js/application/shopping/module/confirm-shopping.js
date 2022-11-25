export default {
  onClickConfirm(context){
    let dataSet = {
      customerId : null,
      rolls: []
    };

    let isWithCustomer = $("#is-with-customer").is(":checked");
    let selectedCustomer = $("#select-customer").find("option:selected").val();


    if(isWithCustomer && selectedCustomer!= ""){
      dataSet.customerId = selectedCustomer;
    }

    let tableRows = $("#summary-payment-container tbody tr");
    tableRows.each(function(){
     let rollId = $(this).find("td").eq(0).text();
     let quantityRoll = $(this).find("td").eq(3).text();
     let quantityUnit = $(this).find("td").eq(5).text();
     let subTotal = $(this).find("td").eq(7).text();

     let roll = {rollId, quantityRoll, quantityUnit, subTotal};

     dataSet.rolls.push(roll);
    })

    console.log(dataSet);
  }
}