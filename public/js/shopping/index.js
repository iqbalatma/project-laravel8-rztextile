/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/application/shopping/module/button.js":
/*!************************************************************!*\
  !*** ./resources/js/application/shopping/module/button.js ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _module_alert__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../module/alert */ "./resources/js/module/alert.js");
/* harmony import */ var _module_helper__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../module/helper */ "./resources/js/module/helper.js");



/**
 * Description : use to add behavior when button is click
 * 
 * @param {object} context context for button element
 */
function onClickButtomRemove(context) {
  var row = $(context).closest("tr");
  var tbody = $(row).parent().find("tr");
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
  if (tbody.length == 1) {
    button.hideButtonSummaryPayment();
  }
}

/**
 * Description : use to add behavior when button is click
 * @param {object} context context for button element
 */
function onClickButtonMinus(context) {
  var row = $(context).closest("tr");
  var tbody = $(row).parent().find("tr");
  var code = $(row).attr("class");
  var quantityRoll = parseInt($(row).find(".quantity-roll").text().split(" ")[0]) - 1;
  var sellingPrice = _module_helper__WEBPACK_IMPORTED_MODULE_1__["default"].formatRupiahToInt($(row).find(".selling-price").text());
  var quantityUnitPerRoll = parseInt($(row).find(".quantity-unit-per-roll").text().split(" ")[0]);
  var quantityUnit = $(row).find(".quantity-unit").text().split(" ");
  var unitName = quantityUnit[1];
  quantityUnit = parseInt(quantityUnit[0]);
  var newQuantityUnit = quantityRoll * quantityUnitPerRoll;
  var newSubTotal = _module_helper__WEBPACK_IMPORTED_MODULE_1__["default"].formatIntToRupiah(sellingPrice * newQuantityUnit);
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

  if (quantityRoll == 0) {
    $(row).remove();
    if (tbody.length == 1) {
      button.hideButtonSummaryPayment();
    }
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
  var sellingPrice = _module_helper__WEBPACK_IMPORTED_MODULE_1__["default"].formatRupiahToInt($(row).find(".selling-price").text());
  var quantityRoll = parseInt($(row).find(".quantity-roll").text().split(" ")[0]) + 1;
  var quantityUnitPerRoll = parseInt($(row).find(".quantity-unit-per-roll").text().split(" ")[0]);
  var quantityUnit = $(row).find(".quantity-unit").text().split(" ");
  var unitName = quantityUnit[1];
  quantityUnit = parseInt(quantityUnit[0]);
  var newQuantityUnit = quantityRoll * quantityUnitPerRoll;
  var newSubTotal = _module_helper__WEBPACK_IMPORTED_MODULE_1__["default"].formatIntToRupiah(sellingPrice * newQuantityUnit);
  var availableRoll = parseInt($(row).find(".available-quantity-roll").text().split(" ")[0]) - 1;
  var availableUnit = parseInt($(row).find(".available-quantity-unit").text().split(" ")[0]) - 1 * quantityUnitPerRoll;
  if (availableRoll < 0 || availableUnit < 0) {
    return (0,_module_alert__WEBPACK_IMPORTED_MODULE_0__.alertQuantityNotEnough)();
  }
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

var button = {
  /**
   * Description : use to show button summary payment
   * 
   */
  showButtonSummaryPayment: function showButtonSummaryPayment() {
    $("#btn-summary-payment").removeClass("d-none");
  },
  hideButtonSummaryPayment: function hideButtonSummaryPayment() {
    $("#btn-summary-payment").addClass("d-none");
  },
  /**
   * Description : use to add button plus on column action
   * 
   * @returns html element for button plus
   */
  getButtonPlusElement: function getButtonPlusElement() {
    return $("<button>", {
      "class": "btn btn-primary btn-sm btn-plus-roll",
      type: "button",
      click: function click() {
        onClickButtonPlus(this);
      }
    }).append($("<i>", {
      "class": "fa-solid fa-square-plus"
    }));
  },
  /**
   * Description : use to get button minus element
   * 
   * @returns html elemen of button minus
   */
  getButtonMinusElement: function getButtonMinusElement() {
    return $("<button>", {
      "class": "btn btn-danger btn-sm btn-minus-roll",
      type: "button",
      click: function click() {
        onClickButtonMinus(this);
      }
    }).append($("<i>", {
      "class": "fa-solid fa-square-minus"
    }));
  },
  /**
   * Description : use to get html element for remove button
   * 
   * @returns html element
   */
  getButtonRemoveElement: function getButtonRemoveElement() {
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
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (button);

/***/ }),

/***/ "./resources/js/application/shopping/module/confirm-shopping.js":
/*!**********************************************************************!*\
  !*** ./resources/js/application/shopping/module/confirm-shopping.js ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function purchase(dataSet) {
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
  }).done(function (response) {
    console.log(response);
  }).fail(function (response) {
    console.log(response);
  });
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  onClickConfirm: function onClickConfirm(context) {
    var dataSet = {
      customer_id: null,
      payment_type: $("#payment-type").find("option:selected").val(),
      rolls: []
    };
    var isWithCustomer = $("#is-with-customer").is(":checked");
    var selectedCustomer = $("#select-customer").find("option:selected").val();
    if (isWithCustomer && selectedCustomer != "") {
      dataSet.customer_id = selectedCustomer;
    }
    var tableRows = $("#summary-payment-container tbody tr");
    tableRows.each(function () {
      var roll_id = $(this).find("td").eq(0).text();
      var quantity_roll = $(this).find("td").eq(3).text();
      var quantity_unit = $(this).find("td").eq(5).text();
      var sub_total = $(this).find("td").eq(7).text();
      var roll = {
        roll_id: roll_id,
        quantity_roll: quantity_roll,
        quantity_unit: quantity_unit,
        sub_total: sub_total
      };
      dataSet.rolls.push(roll);
    });
    purchase(dataSet);
  }
});

/***/ }),

/***/ "./resources/js/application/shopping/module/quantity-roll.js":
/*!*******************************************************************!*\
  !*** ./resources/js/application/shopping/module/quantity-roll.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _module_alert__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../module/alert */ "./resources/js/module/alert.js");
/* harmony import */ var _module_helper__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../module/helper */ "./resources/js/module/helper.js");


var tempData = {
  value: null,
  setValue: function setValue(value) {
    this.value = value;
  },
  getValue: function getValue() {
    return this.value;
  }
};
function onClickQuantityRoll(context) {
  tempData.setValue(parseInt($(context).text()));
  $(context).text(parseInt($(context).text()));
}
function onBlurQuantityRoll(context, unitName) {
  var row = $(context).closest("tr");
  var quantityRoll = parseInt($(row).find(".quantity-roll").text());
  var quantityUnit = parseInt($(row).find(".quantity-unit").text());
  var unitPerRoll = parseInt($(row).find(".quantity-unit-per-roll").text());
  var sellingPrice = _module_helper__WEBPACK_IMPORTED_MODULE_1__["default"].formatRupiahToInt($(row).find(".selling-price").text());
  var availableQuantityRoll = parseInt($(row).find(".available-quantity-roll").text());
  var availableQuantityUnit = parseInt($(row).find(".available-quantity-unit").text());
  var newQuantityUnit = quantityRoll * unitPerRoll;
  var newSubTotal = sellingPrice * newQuantityUnit;
  var diffrenceUnit = newQuantityUnit - quantityUnit;
  var diffrenceRoll = quantityRoll - tempData.getValue();
  var newAvailableQuantityUnit = availableQuantityUnit - diffrenceUnit;
  var newAvailableQuantityRoll = availableQuantityRoll - diffrenceRoll;
  if (newAvailableQuantityUnit < 0 || newAvailableQuantityRoll < 0) {
    $(context).text("".concat(tempData.getValue(), " roll"));
    if (tempData.getValue() != quantityRoll) {
      return (0,_module_alert__WEBPACK_IMPORTED_MODULE_0__.alertQuantityNotEnough)();
    }
    return false;
  }
  $(row).find(".quantity-roll").text("".concat(quantityRoll, " roll"));
  $(row).find(".sub-total").text("".concat(_module_helper__WEBPACK_IMPORTED_MODULE_1__["default"].formatIntToRupiah(newSubTotal)));
  $(row).find(".available-quantity-unit").text("".concat(newAvailableQuantityUnit, " ").concat(unitName));
  $(row).find(".available-quantity-roll").text("".concat(newAvailableQuantityRoll, " roll"));
  $(row).find(".quantity-unit").text("".concat(newQuantityUnit, " ").concat(unitName));
}
function onKeyPressQuantityRoll(context, event) {
  _module_helper__WEBPACK_IMPORTED_MODULE_1__["default"].preventEnter(context, event);
  _module_helper__WEBPACK_IMPORTED_MODULE_1__["default"].prenvetNonNumeric(event);
}
function onKeyDownQuantityRoll(context, event) {
  _module_helper__WEBPACK_IMPORTED_MODULE_1__["default"].preventTab(context, event);
}
function onFocusQuantityRoll(context) {
  $(context).text("".concat(parseInt($(context).text())));
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  getQuantityRollElement: function getQuantityRollElement(unitName) {
    return $("<td>", {
      text: "1 roll",
      "class": "text-nowrap quantity-roll",
      attr: {
        contenteditable: true
      },
      click: function click() {
        onClickQuantityRoll(this);
      },
      blur: function blur() {
        onBlurQuantityRoll(this, unitName);
      },
      focus: function focus() {
        onFocusQuantityRoll(this);
      },
      keypress: function keypress(event) {
        onKeyPressQuantityRoll(this, event);
      },
      keydown: function keydown(event) {
        onKeyDownQuantityRoll(this, event);
      }
    });
  }
});

/***/ }),

/***/ "./resources/js/application/shopping/module/selling-price.js":
/*!*******************************************************************!*\
  !*** ./resources/js/application/shopping/module/selling-price.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _module_helper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../module/helper */ "./resources/js/module/helper.js");

function onClickSellingPrice(context) {
  $(context).text(_module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].formatRupiahToInt($(context).text()));
}
function onKeyPressSellingPrice(context, event) {
  _module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].preventEnter(context, event);
  _module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].prenvetNonNumeric(event);
}
function onBlurSellingPrice(context) {
  var row = $(context).closest("tr");
  var sellingPrice = $(row).find(".selling-price").text();
  var quantityUnit = parseInt($(row).find(".quantity-unit").text());
  var newSubTotal = sellingPrice * quantityUnit;
  $(row).find(".sub-total").text(_module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].formatIntToRupiah(newSubTotal));
  $(row).find(".selling-price").text(_module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].formatIntToRupiah(sellingPrice));
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  getSellingPriceElement: function getSellingPriceElement(sellingPrice) {
    return $("<td>", {
      text: _module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].formatIntToRupiah(sellingPrice),
      "class": "text-nowrap selling-price",
      attr: {
        contenteditable: true
      },
      click: function click() {
        onClickSellingPrice(this);
      },
      blur: function blur() {
        onBlurSellingPrice(this);
      },
      keypress: function keypress(event) {
        onKeyPressSellingPrice(this, event);
      }
    });
  }
});

/***/ }),

/***/ "./resources/js/application/shopping/module/unit-per-roll.js":
/*!*******************************************************************!*\
  !*** ./resources/js/application/shopping/module/unit-per-roll.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _module_alert__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../module/alert */ "./resources/js/module/alert.js");
/* harmony import */ var _module_helper__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../module/helper */ "./resources/js/module/helper.js");


var tempData = {
  value: null,
  setValue: function setValue(value) {
    this.value = value;
  },
  getValue: function getValue() {
    return this.value;
  }
};
function onClickUnitPerRoll(context) {
  $(context).text(parseInt($(context).text()));
  tempData.setValue(parseInt($(context).text()));
}
function onBlurUnitPerRoll(context, unitName) {
  var row = $(context).closest("tr");
  var quantityRoll = parseInt($(row).find(".quantity-roll").text());
  var quantityUnit = parseInt($(row).find(".quantity-unit").text());
  var unitPerRoll = parseInt($(context).text());
  var sellingPrice = _module_helper__WEBPACK_IMPORTED_MODULE_1__["default"].formatRupiahToInt($(row).find(".selling-price").text());
  var availableQuantityUnit = parseInt($(row).find(".available-quantity-unit").text());
  var newQuantityUnit = quantityRoll * unitPerRoll;
  var newSubTotal = sellingPrice * newQuantityUnit;
  var diffrence = newQuantityUnit - quantityUnit;
  var newAvailableQuantityUnit = availableQuantityUnit - diffrence;
  if (newAvailableQuantityUnit < 0) {
    $(context).text("".concat(tempData.getValue(), " ").concat(unitName));
    if (tempData.getValue() != unitPerRoll) {
      return (0,_module_alert__WEBPACK_IMPORTED_MODULE_0__.alertQuantityNotEnough)();
    }
    return false;
  }
  $(row).find(".quantity-unit").text("".concat(newQuantityUnit, " ").concat(unitName));
  $(row).find(".available-quantity-unit").text("".concat(newAvailableQuantityUnit, " ").concat(unitName));
  $(row).find(".sub-total").text("".concat(_module_helper__WEBPACK_IMPORTED_MODULE_1__["default"].formatIntToRupiah(newSubTotal)));
  $(context).text("".concat(unitPerRoll, " ").concat(unitName));
}
function onKeyPressUnitPerRoll(context, event) {
  _module_helper__WEBPACK_IMPORTED_MODULE_1__["default"].preventEnter(context, event);
  _module_helper__WEBPACK_IMPORTED_MODULE_1__["default"].prenvetNonNumeric(event);
}
function onKeyDownUnitPerRoll(context, event) {
  _module_helper__WEBPACK_IMPORTED_MODULE_1__["default"].preventTab(context, event);
}
function onFocusUnitPerRoll(context) {
  $(context).text("".concat(parseInt($(context).text())));
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  getUnitPerRollElement: function getUnitPerRollElement(unitName) {
    return $("<td>", {
      text: "1 ".concat(unitName),
      "class": "text-nowrap quantity-unit-per-roll",
      attr: {
        contenteditable: true
      },
      click: function click() {
        onClickUnitPerRoll(this);
      },
      focus: function focus() {
        onFocusUnitPerRoll(this);
      },
      blur: function blur() {
        onBlurUnitPerRoll(this, unitName);
      },
      keypress: function keypress(event) {
        onKeyPressUnitPerRoll(this, event);
      },
      keydown: function keydown(event) {
        onKeyDownUnitPerRoll(this, event);
      }
    });
  }
});

/***/ }),

/***/ "./resources/js/module/alert.js":
/*!**************************************!*\
  !*** ./resources/js/module/alert.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "alertQuantityNotEnough": () => (/* binding */ alertQuantityNotEnough)
/* harmony export */ });
function alertQuantityNotEnough() {
  return Swal.fire({
    icon: 'error',
    title: 'Action cannot be done !',
    text: 'Item availability is not enough!'
  });
}


/***/ }),

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
  },
  preventEnter: function preventEnter(context, event) {
    if (event.key == "Enter") {
      event.preventDefault();
      $(context).blur();
    }
  },
  prenvetNonNumeric: function prenvetNonNumeric(event) {
    if (event.which < 48 || event.which > 57) {
      event.preventDefault();
    }
  },
  preventTab: function preventTab(context, event) {
    if (event.which == 9) {
      event.preventDefault();
      $(context).next().focus();
    }
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
/* harmony import */ var _module_button__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./module/button */ "./resources/js/application/shopping/module/button.js");
/* harmony import */ var _module_confirm_shopping__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./module/confirm-shopping */ "./resources/js/application/shopping/module/confirm-shopping.js");
/* harmony import */ var _module_quantity_roll__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./module/quantity-roll */ "./resources/js/application/shopping/module/quantity-roll.js");
/* harmony import */ var _module_selling_price__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./module/selling-price */ "./resources/js/application/shopping/module/selling-price.js");
/* harmony import */ var _module_unit_per_roll__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./module/unit-per-roll */ "./resources/js/application/shopping/module/unit-per-roll.js");







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
    _module_button__WEBPACK_IMPORTED_MODULE_1__["default"].showButtonSummaryPayment();
    var table = $("#table-product");
    var tbody = $(table).find("tbody");
    var totalUnitOnTable = getCurrentTotalUnitOnTable(dataSet.code);
    var totalRollOnTable = getCurrentTotalRollOnTable(dataSet.code);
    var tr = $("<tr>", {
      "class": dataSet.code
    });
    tr.append($("<td>".concat(dataSet.id, "</td>")));
    tr.append($("<td>".concat(dataSet.code, "</td>")));
    tr.append($("<td>".concat(dataSet.name, "</td>")));
    tr.append(_module_quantity_roll__WEBPACK_IMPORTED_MODULE_3__["default"].getQuantityRollElement(dataSet.unit.name));
    tr.append(_module_unit_per_roll__WEBPACK_IMPORTED_MODULE_5__["default"].getUnitPerRollElement(dataSet.unit.name));
    tr.append($("<td>", {
      text: "1 ".concat(dataSet.unit.name),
      "class": "text-nowrap quantity-unit"
    }));
    tr.append(_module_selling_price__WEBPACK_IMPORTED_MODULE_4__["default"].getSellingPriceElement(dataSet.selling_price));
    tr.append($("<td>", {
      text: _module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].formatIntToRupiah(dataSet.selling_price),
      "class": "text-nowrap sub-total"
    }));
    tr.append($("<td>", {
      "class": "text-nowrap action-roll"
    }).append($("<div>", {
      "class": "d-grid gap-2 d-md-block"
    }).append(_module_button__WEBPACK_IMPORTED_MODULE_1__["default"].getButtonPlusElement()).append(_module_button__WEBPACK_IMPORTED_MODULE_1__["default"].getButtonMinusElement()).append(_module_button__WEBPACK_IMPORTED_MODULE_1__["default"].getButtonRemoveElement())));
    tr.append($("<td>", {
      text: "".concat(dataSet.quantity_roll, " rolls"),
      "class": "text-nowrap available-quantity-roll"
    }));
    tr.append($("<td>", {
      text: "".concat(dataSet.quantity_unit, " ").concat(dataSet.unit.name),
      "class": "text-nowrap available-quantity-unit"
    }));
    tbody.append(tr);
    updateAvailableQuantityRoll(dataSet.code, dataSet.quantity_roll - 1 - totalRollOnTable);
    updateAvailableQuantityUnit(dataSet.code, dataSet.quantity_unit - 1 - totalUnitOnTable, dataSet.unit.name);
    selectizedFocusAndClear(selectized);
  }
  $("#btn-summary-payment").on("click", function () {
    var summaryPaymentContainer = $("#summary-payment-container");
    $(summaryPaymentContainer).children().remove();
    $("#table-product").clone().appendTo($(summaryPaymentContainer)).attr("id", "table-summary-product").find(".action-roll, .action-roll-header").remove();
    var totalBill = 0;
    $("#table-summary-product").find(".sub-total").each(function () {
      var subTotal = _module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].formatRupiahToInt($(this).text());
      totalBill += subTotal;
    });
    $("#total-bill").val(_module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].formatIntToRupiah(totalBill));
  });
  $("#is-with-customer").on("change", function () {
    if (this.checked) {
      $("#customer-container-modal").removeClass("d-none");
    } else {
      $("#customer-container-modal").addClass("d-none");
    }
  });
  $("#select-customer").on("change", function () {
    var dataCustomer = $(this).find("option:selected").data("json");
    $("#id_number").val(dataCustomer["id_number"]);
    $("#name").val(dataCustomer["name"]);
    $("#address").val(dataCustomer["address"]);
    $("#phone").val(dataCustomer["phone"]);
  });
  $("#btn-confirm-shopping").on("click", function () {
    _module_confirm_shopping__WEBPACK_IMPORTED_MODULE_2__["default"].onClickConfirm(this);
  });
});
})();

/******/ })()
;