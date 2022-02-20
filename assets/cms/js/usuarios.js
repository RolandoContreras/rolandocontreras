function validate_users() {
    var user_id = document.getElementById("user_id").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var first_name = document.getElementById("first_name").value;
    var last_name = document.getElementById("last_name").value;
    var active = document.getElementById("active").value;
    $.ajax({
        type: "post",
        url: site + "dashboard/usuarios/validate",
        dataType: "json",
        data: {user_id: user_id,
            first_name: first_name,
            last_name: last_name,
            password: password,
            email: email,
            active: active
        },
        success: function (data) {
            if (data.status == true) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Cambios Guardado',
                    showConfirmButton: false,
                    timer: 1500
                });
                window.setTimeout(function () {
                    window.location = site + "dashboard/usuarios";
                }, 1500);
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Sucedio un error',
                    footer: 'Comunique a soporte'
                });
            }
        }
    });
}
function new_users() {
    var url = 'dashboard/usuarios/load';
    location.href = site + url;
}
function edit_users(user_id) {
    var url = 'dashboard/usuarios/load/' + user_id;
    location.href = site + url;
}
function cancelar_users() {
    var url = 'dashboard/usuarios';
    location.href = site + url;
}
function delete_users(user_id) {
    bootbox.confirm({
        message: "¿Confirma que desea eliminar al usuario?",
        buttons: {
            confirm: {
                label: 'Confirmar',
                className: 'btn-success'
            },
            cancel: {
                label: 'Cerrar',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result == true) {
                $.ajax({
                    type: "post",
                    url: site + "dashboard/usuarios/delete",
                    dataType: "json",
                    data: {user_id: user_id},
                    success: function (data) {
                        if (data.status == true) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'El usuario fue eliminado',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            window.setTimeout(function () {
                                location.reload();
                            }, 1500);
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Sucedio un error',
                                footer: 'Comunique a soporte'
                            });
                        }
                    }
                });
            }
        }
    });
}
