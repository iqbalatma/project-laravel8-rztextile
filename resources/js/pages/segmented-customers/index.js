import jquery from "jquery";
window.$ = jquery;
import "datatables.net";
import "datatables.net-bs5";

$(document).ready(function () {
    $("table").DataTable();
});
