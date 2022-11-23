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
  formatToRupiah: function formatToRupiah(number) {
    return "Rp " + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ",00";
  },
  rupiahToInt: function rupiahToInt(rupiah) {
    var rupiahInt = rupiah.split(" ");
    rupiahInt = rupiahInt[1];
    rupiahInt = rupiahInt.replaceAll(".", "");
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
$(document).ready(function () {
  function selectizedFocusAndClear(selectized) {
    selectized = selectized[0].selectize;
    selectized.focus();
    selectized.off();
    selectized.clear();
    selectized.on("change", function (value, isOnInitialize) {
      onChangeSelectize(value, isOnInitialize);
    });
  }

  // selectize configuration
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

  // initialize selectize 
  var selectized = $("#select-roll").selectize(selectizeOption);
  selectizedFocusAndClear(selectized);
  function onChangeSelectize(value) {
    var rollId = value;
    var dataSet = $(".item-roll-selectized[data-id=\"".concat(rollId, "\"]")).data("data");
    setSelectedOptionToTableRow(dataSet);
  }
  function setSelectedOptionToTableRow(dataSet) {
    var table = $("#table-product");
    var tbody = $(table).find("tbody");
    var totalUnitOnTable = getCurrentTotalUnitOnTable(dataSet.code);
    var totalRollOnTable = getCurrentTotalRollOnTable(dataSet.code);
    console.log(totalUnitOnTable);
    console.log(totalRollOnTable);
    tbody.append("\n      <tr class=\"".concat(dataSet.code, "\">\n        <td>").concat(dataSet.id, "</td>\n        <td>").concat(dataSet.code, "</td>\n        <td>").concat(dataSet.name, "</td>\n        <td class=\"text-nowrap quantity-roll\">1 roll</td>\n        <td class=\"text-nowrap\">1 ").concat(dataSet.unit.name, "</td>\n        <td class=\"text-nowrap quantity-unit\">1 ").concat(dataSet.unit.name, "</td>\n        <td class=\"text-nowrap\">").concat(_module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].formatToRupiah(dataSet.selling_price), "</td>\n        <td class=\"text-nowrap\">").concat(_module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].formatToRupiah(dataSet.selling_price), "</td>\n        <td class=\"text-nowrap\">\n          <div class=\"d-grid gap-2 d-md-block\">\n            <button class=\"btn btn-primary btn-sm\" type=\"button\">\n              <i class=\"fa-solid fa-square-plus\"></i>\n            </button>\n            <button class=\"btn btn-secondary btn-sm\" type=\"button\">\n              <i class=\"fa-solid fa-square-minus\"></i>\n            </button>\n            <button class=\"btn btn-danger btn-sm\" type=\"button\">\n              <i class=\"fa-solid fa-trash\"></i>\n            </button>\n          </div>\n        </td>\n        <td class=\"text-nowrap\">").concat(dataSet.quantity_roll, " rolls</td>\n        <td class=\"text-nowrap\">").concat(dataSet.quantity_unit, " ").concat(dataSet.unit.name, "</td>\n      </tr>\n    "));
    selectizedFocusAndClear(selectized);
  }
});
})();

/******/ })()
;