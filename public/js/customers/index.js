$(document).ready(function () {
    $(".btn-delete").on("click", function () {
        var t = $(this).closest("form");
        Swal.fire({
            title: "Are you sure want to delete the unit ?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then(function (e) {
            e.isConfirmed && t.submit();
        });
    });
});
