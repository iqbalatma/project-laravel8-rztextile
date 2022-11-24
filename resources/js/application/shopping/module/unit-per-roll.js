import helper from "../../../module/helper";

function onClickUnitPerRoll(context){
  $(context).text(parseInt($(context).text()));
}

function onBlurUnitPerRoll(context, unitName){
  let row = $(context).closest("tr");
  let quantityRoll = parseInt($(row).find(".quantity-roll").text());
  let unitPerRoll = parseInt($(context).text());
  let unitQuantity = quantityRoll * unitPerRoll;


  $(row).find(".quantity-unit").text(`${unitQuantity} ${unitName}`)
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

