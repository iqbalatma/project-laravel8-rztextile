import { alertQuantityNotEnough } from "../../../module/alert";
import helper from "../../../module/helper";
const tempData = {
  value:null,

  setValue: function(value){
    this.value = value;
  },

  getValue: function(){
    return this.value;
  }
}

function onClickUnitPerRoll(context){
  $(context).text(parseInt($(context).text()));
  tempData.setValue(parseInt($(context).text()));
}

function onBlurUnitPerRoll(context, unitName){
  let row = $(context).closest("tr");
  let quantityRoll = parseInt($(row).find(".quantity-roll").text());
  let unitPerRoll = parseInt($(context).text());
  let sellingPrice = helper.formatRupiahToInt($(row).find(".selling-price").text());
  let availableQuantityUnit = parseInt($(row).find(".available-quantity-unit").text());

  let newQuantityUnit = quantityRoll * unitPerRoll;
  let newSubTotal = sellingPrice * newQuantityUnit;
  let newAvailableQuantityUnit = availableQuantityUnit - newQuantityUnit;
  
  if(newAvailableQuantityUnit<0){
    $(context).text(`${tempData.getValue()} ${unitName}`);
    return alertQuantityNotEnough();
  }

  $(row).find(".quantity-unit").text(`${newQuantityUnit} ${unitName}`)
  $(row).find(".available-quantity-unit").text(`${newAvailableQuantityUnit} ${unitName}`)
  $(row).find(".sub-total").text(`${helper.formatIntToRupiah(newSubTotal)}`)
  $(context).text(`${unitPerRoll} ${unitName}`);
}

function onKeyPressUnitPerRoll(context, event){
  helper.preventEnter(context, event);
  helper.prenvetNonNumeric(event);
}

function onKeyDownUnitPerRoll(context, event){
  helper.preventTab(context, event);
}


export default {
  getUnitPerRollElement(unitName){
    return $(`<td>`,{
      text: `1 ${unitName}`,
      class: "text-nowrap quantity-unit-per-roll",
      attr:{
        contenteditable:true
      },
      click: function(){
        onClickUnitPerRoll(this);
      },
      blur: function(){
        onBlurUnitPerRoll(this, unitName);
      },
      keypress: function(event){
        onKeyPressUnitPerRoll(this, event);
      },
      keydown: function(event){
        onKeyDownUnitPerRoll(this, event)
      }
    });
  },
}

