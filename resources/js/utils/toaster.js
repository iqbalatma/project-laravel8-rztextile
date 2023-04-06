import Swal from "sweetalert2";

function toaster({message, icon, config}){
    if(config==undefined){
        config = {
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        };
    }
    if(icon==undefined){
        icon = "success";
    }

    const Toast = Swal.mixin(config)

    Toast.fire({
        title: message,
        icon: icon
    });
}


export {toaster}
