import Swal from "sweetalert2";
import helper from "../../module/helper"
import button from "./module/button";
import unitPerRoll from "./module/unit-per-roll";



/**
 * Description : use to get all total quantity unit selected option on table
 * 
 * @param {string} code 
 * @returns 
 */
function getCurrentTotalUnitOnTable(code){
  let row = $(`.${code}`);

  let totalUnit = 0;
  if(row.length>0){
    row.each(function(){
      let subTotalunit = $(this).find(".quantity-unit").text();
      subTotalunit = parseInt(subTotalunit.split(" ")[0]);
      totalUnit += subTotalunit;
    });
  }

  return totalUnit;
}

/**
 * Description : use to get all total quantity roll selected option on table
 * 
 * @param {string} code 
 * @returns int 
 */
function getCurrentTotalRollOnTable(code){
  let row = $(`.${code}`);

  let totalRoll = 0;
  if(row.length>0){
    row.each(function(){
      let subtotalRoll = $(this).find(".quantity-roll").text();
      subtotalRoll = parseInt(subtotalRoll.split(" ")[0]);
      totalRoll += subtotalRoll;
    });
  }

  return totalRoll;
}

/**
 * Description : use to update available quantity roll when add new row
 * 
 * @param {string} code code of roll that selected on selectize
 * @param {int} availableRoll available roll that want to setup
 */
function updateAvailableQuantityRoll(code,availableRoll){
  let row = $(`.${code}`);

  if(row.length>0){
    row.each(function(){
      $(this).find(".available-quantity-roll").text(availableRoll + " roll");
    });
  }
} 

/**
 * Description : use to update available quantity unit when add new row
 * 
 * @param {string} code 
 * @param {int} availableRoll 
 * @param {string} unitName 
 */
function updateAvailableQuantityUnit(code,availableRoll,unitName){
  let row = $(`.${code}`);

  if(row.length>0){
    row.each(function(){
      $(this).find(".available-quantity-unit").text(availableRoll + ` ${unitName}`);
    });
  }
} 



/**
 * Description : selectize option configuration
 */
const selectizeOption = {
  create: false,
  sortField: "text",
  openOnFocus: false,
  render: {
      option: function(data, escape) {
          return `<div class="item-roll-selectized"
                      data-id="${escape(data.data.id)}"
                      data-data="${escape(JSON.stringify(data.data))}">
                      ${escape(data.data.id)} | ${escape(data.data.qrcode)} | ${escape(data.text)}
                  </div>`
      }
  },
  onChange: function(value) {
    onChangeSelectize(value)
  }
}

$(document).ready(function(){
  /**
   * Description : use to clear and always focus on selectize
   * 
   * @param {object} selectized initialize of selectize
   */
  function selectizedFocusAndClear(selectized) {
    selectized =  selectized[0].selectize;
    selectized.focus();
    selectized.off();
    selectized.clear();
    selectized.on("change", function(value) {
        onChangeSelectize(value);
    });
  }


  // initialize selectize 
  let selectized = $("#select-roll").selectize(selectizeOption);

  selectizedFocusAndClear(selectized);

  /**
   * Description : function that will execute on change selectize
   * 
   * @param {int} value 
   */
  function onChangeSelectize(value) {
    const rollId = value;
    const dataSet =$(`.item-roll-selectized[data-id="${rollId}"]`).data("data"); 

    setSelectedOptionToTableRow(dataSet);
  }

  /**
   * Description : use to add and draw row table
   * 
   * @param {object} dataSet 
   */
  function setSelectedOptionToTableRow(dataSet){
    let table = $("#table-product");
    let tbody = $(table).find("tbody");

    let totalUnitOnTable = getCurrentTotalUnitOnTable(dataSet.code);
    let totalRollOnTable = getCurrentTotalRollOnTable(dataSet.code)

    let tr = $("<tr>",{
      class: dataSet.code
    });

    tr.append($(`<td>${dataSet.id}</td>`))
    tr.append($(`<td>`,{
      text: dataSet.code,
    }))
    tr.append($(`<td>${dataSet.name}</td>`))
    tr.append($(`<td>`,{
      text: "1 roll",
      class: "text-nowrap quantity-roll"
    }));
    tr.append(unitPerRoll.getUnitPerRollElement(dataSet.unit.name));
    tr.append($(`<td>`,{
      text: `1 ${dataSet.unit.name}`,
      class: "text-nowrap quantity-unit",
      attr:{
        contenteditable: true
      }
    }));
    tr.append($(`<td>`,{
      text: helper.formatIntToRupiah(dataSet.selling_price),
      class: "text-nowrap selling-price"
    }));
    tr.append($(`<td>`,{
      text: helper.formatIntToRupiah(dataSet.selling_price),
      class: "text-nowrap sub-total"
    }));

    tr.append($("<td>",{
      class:"text-nowrap"
    }).append($("<div>",{
      class: "d-grid gap-2 d-md-block"
    })
    .append(button.getButtonPlusElement())
    .append(button.getButtonMinusElement())
    .append(button.getButtonRemoveElement())
    ));

    tr.append($(`<td>`,{
      text: `${dataSet.quantity_roll} rolls`,
      class: "text-nowrap available-quantity-roll"
    }));

    tr.append($(`<td>`,{
      text: `${dataSet.quantity_unit} ${dataSet.unit.name}`,
      class: "text-nowrap available-quantity-unit"
    }));

    tbody.append(tr);

    updateAvailableQuantityRoll(
      dataSet.code,
      (dataSet.quantity_roll-1-totalRollOnTable)
    );
    updateAvailableQuantityUnit(
      dataSet.code,
      (dataSet.quantity_unit-1-totalUnitOnTable),
      dataSet.unit.name
    );
    selectizedFocusAndClear(selectized);
  }
});