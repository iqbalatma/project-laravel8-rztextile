$(".btn-delete").on("click", function (event) {
    event.preventDefault();
    const form = $(this).closest("form");
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            form.trigger("submit");
            event.Swal.fire(
                "Deleted!",
                "Your data has been deleted.",
                "success"
            );
        }
    });
});
