export default {
  onClickConfirm(context){
    let dataset = {
      customerId : null,
      roll: []
    };

    let isWithCustomer = $("#is-with-customer").is(":checked");
    let selectedCustomer = $("#select-customer").find("option:selected").val();


    if(isWithCustomer && selectedCustomer!= ""){
      dataset.customerId = selectedCustomer;
    }
  }
}