$(".btn-delete").on("click",(function(e){e.preventDefault();var t=$(this).closest("form");Swal.fire({title:"Are you sure?",text:"You won't be able to revert this!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, Delete it!"}).then((function(o){o.isConfirmed&&(t.trigger("submit"),e.Swal.fire("Deleted!","Your data has been deleted.","success"))}))}));