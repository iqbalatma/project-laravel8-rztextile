/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************************!*\
  !*** ./resources/js/pages/user-managements/index.js ***!
  \******************************************************/
$(".btn-change-status").on("click", function (event) {
  event.preventDefault();
  var form = $(this).closest("form");
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, change the statis!"
  }).then(function (result) {
    if (result.isConfirmed) {
      form.trigger("submit");
      event.Swal.fire("Status Changed!", "Change status active user successfully", "success");
    }
  });
});
/******/ })()
;