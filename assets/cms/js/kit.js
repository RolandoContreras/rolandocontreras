function validate_kit() {
    var kit_id = document.getElementById("kit_id").value;
    var name = document.getElementById("name").value;
    var price = document.getElementById("price").value;
    var point = document.getElementById("point").value;
    var status_value = document.getElementById("status_value").value;
    $.ajax({
        type: "post",
        url: site + "dashboard/kit/validate",
        dataType: "json",
        data: {kit_id: kit_id,
            name: name,
            price: price,
            point: point,
            status_value: status_value
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
                    window.location = site + "dashboard/kit";
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
function edit_kit(kit_id) {
    var url = 'dashboard/kit/load/' + kit_id;
    location.href = site + url;
}
function cancelar_kit() {
    var url = 'dashboard/kit';
    location.href = site + url;
}
function delete_kit(kit_id) {
    bootbox.confirm({
        message: "¿Confirma que desea eliminar el kit?",
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
                    url: site + "dashboard/kit/delete",
                    dataType: "json",
                    data: {kit_id: kit_id},
                    success: function (data) {
                        if (data.status == true) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'El Kit fue eliminado',
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
