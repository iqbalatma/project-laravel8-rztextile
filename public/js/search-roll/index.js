/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************************!*\
  !*** ./resources/js/application/search-roll/index.js ***!
  \*******************************************************/
$(document).ready(function () {
  /**
   * Description : selectize option configuration
   */
  var selectizeOption = {
    create: false,
    sortField: "text",
    openOnFocus: false,
    render: {
      option: function option(data, escape) {
        return "<div class=\"item-roll-selectized\"\n                        data-id=\"".concat(escape(data.data.id), "\"\n                        data-data=\"").concat(escape(JSON.stringify(data.data)), "\">\n                        ").concat(escape(data.text), "\n                    </div>");
      }
    },
    onChange: function onChange(value) {
      onChangeSelectize(value);
    }
  };
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
    selectizedFocusAndClear(selectized);
    $.ajax({
      url: "/ajax/search-roll/" + rollId,
      context: document.body,
      method: "GET"
    }).done(function (response) {
      console.log(response);
    }).fail(function (response) {
      console.log(response);
    });
  }
});
/******/ })()
;