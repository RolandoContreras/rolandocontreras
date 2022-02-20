function login() {
    email = document.getElementById("email").value;
    password = document.getElementById("password").value;
    $.ajax({
        type: "post",
        url: "dashboard/validate",
        dataType: "json",
        data: {email: email,
            password: password},
        success: function (data) {
            if (data.status == true) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: data.print,
                    showConfirmButton: false,
                    timer: 1500
                });
                window.setTimeout(function () {
                    window.location = site + "dashboard/panel";
                }, 1500);
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Datos Invalidos',
                    footer: data.print
                });
            }
        }
    });
}