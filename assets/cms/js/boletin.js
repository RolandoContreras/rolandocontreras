function validate_boletin() {
    var boletin_id = document.getElementById("boletin_id").value;
    var email = document.getElementById("email").value;
    var active = document.getElementById("active").value;
    $.ajax({
        type: "post",
        url: site + "dashboard/boletin/validate",
        dataType: "json",
        data: {boletin_id: boletin_id,
            active: active,
            email: email
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
                    window.location = site + "dashboard/boletin";
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
function edit_boletin(boletin_id) {
    var url = 'dashboard/boletin/load/' + boletin_id;
    location.href = site + url;
}
function cancel_boletin() {
    var url = 'dashboard/boletin';
    location.href = site + url;
}
function delete_boletin(boletin_id) {
    bootbox.confirm({
        message: "¿Confirma que desea eliminar el registro?",
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
                    url: site + "dashboard/boletin/delete",
                    dataType: "json",
                    data: {boletin_id: boletin_id},
                    success: function (data) {
                        if (data.status == true) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'El registro fue eliminado',
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
