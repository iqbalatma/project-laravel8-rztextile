import helper from "../../module/helper";

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


$(document).ready(function(){
  function selectizedFocusAndClear(selectized) {
    selectized =  selectized[0].selectize;
    selectized.focus();
    selectized.off();
    selectized.clear();
    selectized.on("change", function(value, isOnInitialize) {
        onChangeSelectize(value, isOnInitialize);
    });
  }

  
  // selectize configuration
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

  // initialize selectize 
  let selectized = $("#select-roll").selectize(selectizeOption);

  selectizedFocusAndClear(selectized);

  function onChangeSelectize(value) {
    const rollId = value;
    const dataSet =$(`.item-roll-selectized[data-id="${rollId}"]`).data("data"); 

    setSelectedOptionToTableRow(dataSet);
  }


  

  function setSelectedOptionToTableRow(dataSet){
    let table = $("#table-product");
    let tbody = $(table).find("tbody");

    let totalUnitOnTable = getCurrentTotalUnitOnTable(dataSet.code);
    let totalRollOnTable = getCurrentTotalRollOnTable(dataSet.code)

    console.log(totalUnitOnTable);
    console.log(totalRollOnTable);

    tbody.append(`
      <tr class="${dataSet.code}">
        <td>${dataSet.id}</td>
        <td>${dataSet.code}</td>
        <td>${dataSet.name}</td>
        <td class="text-nowrap quantity-roll">1 roll</td>
        <td class="text-nowrap">1 ${dataSet.unit.name}</td>
        <td class="text-nowrap quantity-unit">1 ${dataSet.unit.name}</td>
        <td class="text-nowrap">${helper.formatToRupiah(dataSet.selling_price)}</td>
        <td class="text-nowrap">${helper.formatToRupiah(dataSet.selling_price)}</td>
        <td class="text-nowrap">
          <div class="d-grid gap-2 d-md-block">
            <button class="btn btn-primary btn-sm" type="button">
              <i class="fa-solid fa-square-plus"></i>
            </button>
            <button class="btn btn-secondary btn-sm" type="button">
              <i class="fa-solid fa-square-minus"></i>
            </button>
            <button class="btn btn-danger btn-sm" type="button">
              <i class="fa-solid fa-trash"></i>
            </button>
          </div>
        </td>
        <td class="text-nowrap">${dataSet.quantity_roll} rolls</td>
        <td class="text-nowrap">${dataSet.quantity_unit} ${dataSet.unit.name}</td>
      </tr>
    `);

    selectizedFocusAndClear(selectized);
  }
});