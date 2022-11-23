/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/module/helper.js":
/*!***************************************!*\
  !*** ./resources/js/module/helper.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  formatIntToRupiah: function formatIntToRupiah(number) {
    return "Rp " + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ",00";
  },
  formatRupiahToInt: function formatRupiahToInt(rupiah) {
    var rupiahInt = rupiah.split(" ");
    rupiahInt = rupiahInt[1];
    rupiahInt = rupiahInt.replaceAll(".", "");
    rupiahInt = rupiahInt.split(" ")[0];
    rupiahInt = parseInt(rupiahInt);
    return rupiahInt;
  }
});

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!****************************************************!*\
  !*** ./resources/js/application/shopping/index.js ***!
  \****************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _module_helper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../module/helper */ "./resources/js/module/helper.js");


/**
 * Description : use to get all total quantity unit selected option on table
 * 
 * @param {string} code 
 * @returns 
 */
function getCurrentTotalUnitOnTable(code) {
  var row = $(".".concat(code));
  var totalUnit = 0;
  if (row.length > 0) {
    row.each(function () {
      var subTotalunit = $(this).find(".quantity-unit").text();
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
function getCurrentTotalRollOnTable(code) {
  var row = $(".".concat(code));
  var totalRoll = 0;
  if (row.length > 0) {
    row.each(function () {
      var subtotalRoll = $(this).find(".quantity-roll").text();
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
function updateAvailableQuantityRoll(code, availableRoll) {
  var row = $(".".concat(code));
  if (row.length > 0) {
    row.each(function () {
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
function updateAvailableQuantityUnit(code, availableRoll, unitName) {
  var row = $(".".concat(code));
  if (row.length > 0) {
    row.each(function () {
      $(this).find(".available-quantity-unit").text(availableRoll + " ".concat(unitName));
    });
  }
}

/**
 * Description : use to add behavior when button is click
 * 
 * @param {object} context context for button elemen
 */
function onClickButtonPlus(context) {
  var row = $(context).closest("tr");
  var code = $(row).attr("class");
  var sellingPrice = _module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].formatRupiahToInt($(row).find(".selling-price").text());
  var quantityRoll = parseInt($(row).find(".quantity-roll").text().split(" ")[0]) + 1;
  var quantityUnitPerRoll = parseInt($(row).find(".quantity-unit-per-roll").text().split(" ")[0]);
  var quantityUnit = $(row).find(".quantity-unit").text().split(" ");
  var unitName = quantityUnit[1];
  quantityUnit = parseInt(quantityUnit[0]);
  var newQuantityUnit = quantityRoll * quantityUnitPerRoll;
  var newSubTotal = _module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].formatIntToRupiah(sellingPrice * newQuantityUnit);
  var availableRoll = parseInt($(row).find(".available-quantity-roll").text().split(" ")[0]) - 1;
  var availableUnit = parseInt($(row).find(".available-quantity-unit").text().split(" ")[0]) - 1 * quantityUnitPerRoll;
  $(row).find(".quantity-roll").text("".concat(quantityRoll, " roll"));
  $(row).find(".quantity-unit").text("".concat(newQuantityUnit, " ").concat(unitName));
  $(row).find(".sub-total").text(newSubTotal);
  $(row).parent() //tbody
  .children(".".concat(code)) //all row that has same code
  .find(".available-quantity-roll") //column for availability quantity roll
  .text("".concat(availableRoll, " roll")); //set text on column

  $(row).parent() //tbody
  .children(".".concat(code)) //all row that has same code
  .find(".available-quantity-unit") //column for availability quantity roll
  .text("".concat(availableUnit, " ").concat(unitName)); //set text on column
}

/**
 * Description : use to add behavior when button is click
 * @param {object} context context for button element
 */
function onClickButtonMinus(context) {
  var row = $(context).closest("tr");
  var code = $(row).attr("class");
  var sellingPrice = _module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].formatRupiahToInt($(row).find(".selling-price").text());
  var quantityRoll = parseInt($(row).find(".quantity-roll").text().split(" ")[0]) - 1;
  var quantityUnitPerRoll = parseInt($(row).find(".quantity-unit-per-roll").text().split(" ")[0]);
  var quantityUnit = $(row).find(".quantity-unit").text().split(" ");
  var unitName = quantityUnit[1];
  quantityUnit = parseInt(quantityUnit[0]);
  var newQuantityUnit = quantityRoll * quantityUnitPerRoll;
  var newSubTotal = _module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].formatIntToRupiah(sellingPrice * newQuantityUnit);
  var availableRoll = parseInt($(row).find(".available-quantity-roll").text().split(" ")[0]) + 1;
  var availableUnit = parseInt($(row).find(".available-quantity-unit").text().split(" ")[0]) + 1 * quantityUnitPerRoll;
  $(row).find(".quantity-roll").text("".concat(quantityRoll, " roll"));
  $(row).find(".quantity-unit").text("".concat(newQuantityUnit, " ").concat(unitName));
  $(row).find(".sub-total").text(newSubTotal);
  $(row).parent() //tbody
  .children(".".concat(code)) //all row that has same code
  .find(".available-quantity-roll") //column for availability quantity roll
  .text("".concat(availableRoll, " roll")); //set text on column

  $(row).parent() //tbody
  .children(".".concat(code)) //all row that has same code
  .find(".available-quantity-unit") //column for availability quantity roll
  .text("".concat(availableUnit, " ").concat(unitName)); //set text on column
}

/**
 * Description : use to add behavior when button is click
 * 
 * @param {object} context context for button element
 */
function onClickButtomRemove(context) {
  var row = $(context).closest("tr");
  var code = $(row).attr("class");
  var quantityRoll = parseInt($(row).find(".quantity-roll").text().split(" ")[0]);
  var quantityUnit = $(row).find(".quantity-unit").text().split(" ");
  var unitName = quantityUnit[1];
  quantityUnit = parseInt(quantityUnit[0]);
  var availableRoll = parseInt($(row).find(".available-quantity-roll").text().split(" ")[0]) + quantityRoll;
  var availableUnit = parseInt($(row).find(".available-quantity-unit").text().split(" ")[0]) + quantityUnit;
  $(row).parent() //tbody
  .children(".".concat(code)) //all row that has same code
  .find(".available-quantity-roll") //column for availability quantity roll
  .text("".concat(availableRoll, " roll")); //set text on column

  $(row).parent() //tbody
  .children(".".concat(code)) //all row that has same code
  .find(".available-quantity-unit") //column for availability quantity roll
  .text("".concat(availableUnit, " ").concat(unitName)); //set text on column

  $(row).remove();
}

/**
 * Description : use to add button plus on column action
 * 
 * @returns html element for button plus
 */
function getButtonPlusElement() {
  return $("<button>", {
    "class": "btn btn-primary btn-sm btn-plus-roll",
    type: "button",
    click: function click() {
      onClickButtonPlus(this);
    }
  }).append($("<i>", {
    "class": "fa-solid fa-square-plus"
  }));
}

/**
 * Description : use to get button minus element
 * 
 * @returns html elemen of button minus
 */
function getButtonMinusElement() {
  return $("<button>", {
    "class": "btn btn-danger btn-sm btn-minus-roll",
    type: "button",
    click: function click() {
      onClickButtonMinus(this);
    }
  }).append($("<i>", {
    "class": "fa-solid fa-square-minus"
  }));
}
function getButtonRemoveElement() {
  return $("<button>", {
    "class": "btn btn-danger btn-sm btn-delete-roll",
    type: "button",
    click: function click() {
      onClickButtomRemove(this);
    }
  }).append($("<i>", {
    "class": "fa-solid fa-trash"
  }));
}

/**
 * Description : selectize option configuration
 */
var selectizeOption = {
  create: false,
  sortField: "text",
  openOnFocus: false,
  render: {
    option: function option(data, escape) {
      return "<div class=\"item-roll-selectized\"\n                      data-id=\"".concat(escape(data.data.id), "\"\n                      data-data=\"").concat(escape(JSON.stringify(data.data)), "\">\n                      ").concat(escape(data.data.id), " | ").concat(escape(data.data.qrcode), " | ").concat(escape(data.text), "\n                  </div>");
    }
  },
  onChange: function onChange(value) {
    onChangeSelectize(value);
  }
};
$(document).ready(function () {
  /**
   * Description : use to clear and always focus on selectize
   * 
   * @param {object} selectized initialize of selectize
   */
  function selectizedFocusAndClear(selectized) {
    selectized = selectized[0].selectize;
    selectized.focus();
    selectized.off();
    selectized.clear();
    selectized.on("change", function (value) {
      onChangeSelectize(value);
    });
  }

  // initialize selectize 
  var selectized = $("#select-roll").selectize(selectizeOption);
  selectizedFocusAndClear(selectized);

  /**
   * Description : function that will execute on change selectize
   * 
   * @param {int} value 
   */
  function onChangeSelectize(value) {
    var rollId = value;
    var dataSet = $(".item-roll-selectized[data-id=\"".concat(rollId, "\"]")).data("data");
    setSelectedOptionToTableRow(dataSet);
  }

  /**
   * Description : use to add and draw row table
   * 
   * @param {object} dataSet 
   */
  function setSelectedOptionToTableRow(dataSet) {
    var table = $("#table-product");
    var tbody = $(table).find("tbody");
    var totalUnitOnTable = getCurrentTotalUnitOnTable(dataSet.code);
    var totalRollOnTable = getCurrentTotalRollOnTable(dataSet.code);
    var tr = $("<tr>", {
      "class": dataSet.code
    });
    tr.append($("<td>".concat(dataSet.id, "</td>")));
    tr.append($("<td>", {
      text: dataSet.code
    }));
    tr.append($("<td>".concat(dataSet.name, "</td>")));
    tr.append($("<td>", {
      text: "1 roll",
      "class": "text-nowrap quantity-roll"
    }));
    tr.append($("<td>", {
      text: "1 ".concat(dataSet.unit.name),
      "class": "text-nowrap quantity-unit-per-roll"
    }));
    tr.append($("<td>", {
      text: "1 ".concat(dataSet.unit.name),
      "class": "text-nowrap quantity-unit"
    }));
    tr.append($("<td>", {
      text: _module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].formatIntToRupiah(dataSet.selling_price),
      "class": "text-nowrap selling-price"
    }));
    tr.append($("<td>", {
      text: _module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].formatIntToRupiah(dataSet.selling_price),
      "class": "text-nowrap sub-total"
    }));
    tr.append($("<td>", {
      "class": "text-nowrap"
    }).append($("<div>", {
      "class": "d-grid gap-2 d-md-block"
    }).append(getButtonPlusElement()).append(getButtonMinusElement()).append(getButtonRemoveElement())));
    tr.append($("<td>", {
      text: "".concat(dataSet.quantity_roll, " rolls"),
      "class": "text-nowrap available-quantity-roll"
    }));
    tr.append($("<td>", {
      text: "".concat(dataSet.quantity_unit, " ").concat(dataSet.unit.name),
      "class": "text-nowrap available-quantity-unit"
    }));
    tbody.append(tr);

    // setActionToButtonPlus();
    updateAvailableQuantityRoll(dataSet.code, dataSet.quantity_roll - 1 - totalRollOnTable);
    updateAvailableQuantityUnit(dataSet.code, dataSet.quantity_unit - 1 - totalUnitOnTable, dataSet.unit.name);
    selectizedFocusAndClear(selectized);
  }
});
})();

/******/ })()
;