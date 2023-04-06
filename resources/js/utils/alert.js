import Swal from "sweetalert2";

function alertError(message, newConfig){
    let config = {
        icon: 'error',
        title: 'Oops...',
        text: message,
    }

    if(newConfig!=undefined){
        config = {...config, ...newConfig}
    }

    Swal.fire(config)
}


function alertSuccess(message, newConfig){
    let config = {
        icon: 'success',
        title: 'Success',
        text: message,
    }

    if(newConfig!=undefined){
        config = {...config, ...newConfig}
    }

    Swal.fire(config)
}


function alertConfirm(successCallback, newConfig){
    let config = {
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    };

    if(newConfig != undefined){
        config = {...config, ...newConfig}
    }

    Swal.fire(config).then((result) => {
        if (result.isConfirmed &&  typeof successCallback == "function" ) {
            successCallback();
        }
    })
}

export {alertError, alertSuccess, alertConfirm}
